<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();
class SimpleComp extends CBitrixComponent
{
    private function modulesCheck()
    {
        if (!Bitrix\Main\Loader::includeModule("iblock")) 
        {
            throw new \Exception('Modules error');
        }

        return true;
    }
    private function result()
    {
        $arNewsFilter = ['IBLOCK_ID' => $this->arParams['NEWS_IBLOCK_ID']];
        $arNewsSelect = ['IBLOCK_ID', 'ID', 'NAME', 'DATE_ACTIVE_FROM'];
        $news = CIBlockElement::GetList([], $arNewsFilter, false, false, $arNewsSelect);

        while ($newsElement = $news->Fetch()){
	        $arNewsID[] = $newsElement['ID'];
            $result['NEWS'][$newsElement['ID']] = $newsElement;
        }
        $arCatalogFilter = ['IBLOCK_ID' => $this->arParams['CATALOG_IBLOCK_ID'], 'ACTIVE' => 'Y', 'UF_NEWS_LINK' => $arNewsID];
        $arCatalogSelect = ['IBLOCK_ID', 'ID', 'NAME', 'UF_NEWS_LINK'];
        $section = CIBlockSection::GetList([], $arCatalogFilter, false, $arCatalogSelect);

        while ($sectionElement = $section->Fetch()) {
            $arSectionID[] = $sectionElement['ID'];
            foreach ($sectionElement['UF_NEWS_LINK'] as $newsLink) {
                $result['NEWS_WITH_SECTIONS'][$newsLink][] = $sectionElement['ID'];
            }
            $result['SECTIONS'][$sectionElement['ID']] = $sectionElement;

        }

        $arElementFilter = ['IBLOCK_ID' => $this->arParams['CATALOG_IBLOCK_ID'], 'ACTIVE' => 'Y', 'SECTION_ID' => $arSectionID];
        $arElementSelect = ['IBLOCK_ID', 'ID', 'NAME', 'PROPERTY_PRICE', 'PROPERTY_MATERIAL', 'PROPERTY_ARTNUMBER', 'IBLOCK_SECTION_ID'];
        $elementsResult = CIBlockElement::GetList([], $arElementFilter, false, false, $arElementSelect);
        $result['ELEMENTS_COUNT'] = $elementsResult->SelectedRowsCount();
        while ($catalogElement = $elementsResult->Fetch()){
            $sectionsWithElements[$catalogElement['IBLOCK_SECTION_ID']][] = $catalogElement['ID'];
            $result['ELEMENTS'][$catalogElement['ID']] = $catalogElement;
        }

        foreach ($result['NEWS_WITH_SECTIONS'] as $news => $sections) {
            $result['NEWS_WITH_ELEMENTS'][$news] = [];
            foreach($sections as $section){
                $result['NEWS_WITH_ELEMENTS'][$news] = array_merge($result['NEWS_WITH_ELEMENTS'][$news], $sectionsWithElements[$section]);
            }
        }

        
        return $result;            
    }

    public function executeComponent()
    {
        $this->modulesCheck();
        if($this->startResultCache()){
            $this->arResult = $this->result();
            $this->SetResultCacheKeys(['ELEMENTS_COUNT']);
            $this->IncludeComponentTemplate();
        }
        $GLOBALS['APPLICATION']->SetTitle("В каталоге товаров представлено товаров: " . $this->arResult['ELEMENTS_COUNT']);
    }
}