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

    private function getNews()
    {
        $arNewsFilter = ['IBLOCK_ID' => $this->arParams['NEWS_IBLOCK_ID']];
        $arNewsSelect = ['IBLOCK_ID', 'ID', 'NAME', 'DATE_ACTIVE_FROM'];
        return CIBlockElement::GetList([], $arNewsFilter, false, false, $arNewsSelect);
    }

    private function getSections($arNewsID)
    {
        $arCatalogFilter = ['IBLOCK_ID' => $this->arParams['CATALOG_IBLOCK_ID'], 'ACTIVE' => 'Y', 'UF_NEWS_LINK' => $arNewsID];
        $arCatalogSelect = ['IBLOCK_ID', 'ID', 'NAME', 'UF_NEWS_LINK'];
        return CIBlockSection::GetList([], $arCatalogFilter, false, $arCatalogSelect);
    }

    private function getElements($arSectionID)
    {
        $arElementFilter = ['IBLOCK_ID' => $this->arParams['CATALOG_IBLOCK_ID'], 'ACTIVE' => 'Y', 'SECTION_ID' => $arSectionID];
        $arElementSelect = ['IBLOCK_ID', 'ID', 'NAME', 'PROPERTY_PRICE', 'PROPERTY_MATERIAL', 'PROPERTY_ARTNUMBER', 'IBLOCK_SECTION_ID'];
        return CIBlockElement::GetList([], $arElementFilter, false, false, $arElementSelect);
    }

    private function result()
    {
        $news = $this->getNews();
        while ($newsElement = $news->Fetch()){
	        $arNewsID[] = $newsElement['ID'];
            $result['NEWS'][$newsElement['ID']] = $newsElement;
        }

        $section = $this->getSections($arNewsID);
        while ($sectionElement = $section->Fetch()) {
            $arSectionID[] = $sectionElement['ID'];
            foreach ($sectionElement['UF_NEWS_LINK'] as $newsLink) {
                $result['NEWS_WITH_SECTIONS'][$newsLink][] = $sectionElement['ID'];
            }
            $result['SECTIONS'][$sectionElement['ID']] = $sectionElement;
        }
        
        $elementsResult = $this->getElements($arSectionID);
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
        
        foreach($result['ELEMENTS'] as $element){
            $arPrice[] = $element["PROPERTY_PRICE_VALUE"];
        }
            
        $result["MIN_PRICE"] = min($arPrice);
        $result["MAX_PRICE"] = max($arPrice);
    
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