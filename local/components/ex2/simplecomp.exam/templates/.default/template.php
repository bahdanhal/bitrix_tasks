<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
	<div>
		<h3> Элементов: <?=$arResult['ELEMENTS_COUNT'];?></h3>
	    <ul>
            <?php foreach ($arResult['NEWS'] as $news):?>   
                <?php $info = '<b>' . $news['NAME'] . '</b> - ' . $news['DATE_ACTIVE_FROM'] . ' (';?>
                <?php $count = 0;?>
                <?php $sections = $arResult['NEWS_WITH_SECTIONS'][$news['ID']];?>
                <?php foreach ($sections as $section):?>
                    <?php if($count == 0):?>
                        <?php $info .= $arResult['SECTIONS'][$section]['NAME'];?>
                    <?php else:?>
                        <?php $info .= ', ' . $arResult['SECTIONS'][$section]['NAME'];?>;
                    <?php endif;?>
                    <?php $count++;?>
                <?php endforeach;?>
                <?php $info .= ')';?>

                <li> <?=$info;?></li>
                    <ul>
                        <?php foreach ($arResult['NEWS_WITH_ELEMENTS'][$news['ID']] as $value):?>
                            <?php $element = $arResult['ELEMENTS'][$value];?>
                            <li> 
                                <?php echo $element['NAME'] . ' - ' . $element['PROPERTY_PRICE_VALUE'] . ' - ' . $element['PROPERTY_MATERIAL_VALUE'] . ' - ' . $element['PROPERTY_ARTNUMBER_VALUE'];?>
                            </li>
                        <?php endforeach;?>
                    </ul>
            <?php endforeach;?>
	    </ul>
    </div>