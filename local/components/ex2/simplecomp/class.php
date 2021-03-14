<?
if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();

use Bitrix\Main\Loader,
	Bitrix\Iblock;
class CSimpleComp extends CBitrixComponent
{
	private $user;
	public function executeComponent()
	{
		$this->user = $GLOBALS['USER'];
		if(!$this->user->IsAuthorized()){
			echo 'Авторизируйтесь чтобы получить доступ';
			return;
		}
		if($this->startResultCache($this->arParams["CACHE_TIME"], $this->user->GetID())){
            $this->newsSelect();
            $this->SetResultCacheKeys(['NEWS_COUNT']);
            $this->IncludeComponentTemplate();
        }
        $GLOBALS['APPLICATION']->SetTitle("Новостей: " . $this->arResult['NEWS_COUNT']);
	}

	private function newsSelect()
	{
		if (!\Bitrix\Main\Loader::includeModule('iblock')){
			return;
		}
		$news = \Bitrix\Iblock\Elements\ElementNewsTable::getList([
			'select' => ['ID', 'AUTHOR'],
			'filter'  => array(
				'ACTIVE' => 'Y',
			), 
		])->fetchCollection();

		foreach ($news as $element)
		{
			foreach($element->getAuthor()->getAll() as $value){
				$arAuthorsID[$value->getValue()] = $value->getValue();
			}
		}
		unset($arAuthorsID[$this->user->GetID()]);
		$userGroup = $this->getUserGroup();
		$usersList = \Bitrix\Main\UserTable::getList(array(
			'select'  => array('LOGIN', 'ID', 'UF_USER_GROUP'), 
			'filter'  => array(
				'ID' => $arAuthorsID, 
				'UF_USER_GROUP' => $userGroup, 
				'ACTIVE' => 'Y',
			) 
		));
		while($currentUser = $usersList->fetch()){
			$validAuthors[] = $currentUser;
			$arUsersID[] = $currentUser['ID'];
		}
		$this->arResult['VALID_AUTHORS'] = $validAuthors;
		
		$news = \Bitrix\Iblock\Elements\ElementNewsTable::getList([
			'select' => ['ID', 'AUTHOR', 'NAME'],
			'filter'  => array(
				'ACTIVE' => 'Y', 
				'AUTHOR.VALUE' => $arUsersID,
			), 
		])->fetchCollection();
		$count = count($news);
		foreach ($news as $element)
		{
			foreach($element->getAuthor()->getAll() as $value){
				$this->arResult['NEWS_BY_AUTHORS'][$value->getValue()][] = ['NAME' => $element->getName()];
			}
		}
		$this->arResult['NEWS_COUNT'] = $count;
	}


	private function getUserGroup()
	{
		$result = \Bitrix\Main\UserTable::getList(array(
			'select'  => array('NAME','ID','UF_USER_GROUP'),
			'filter'  => array('ID'=>$this->user->GetID()),
		));
		$user = $result->fetch();

		return $user['UF_USER_GROUP'];
	}		
}
