<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
	<div>
		<h3> Элементов: <?=$arResult['ELEMENTS_COUNT'];?></h3>
	    <ul>
            <?php foreach ($arResult as $key => $news):?>   
                <?php if ($key == 'ELEMENTS_COUNT'):?>
                    <?php continue;?>
                <?php endif;?>
                <?php $info = '<b>' . $news['NEWS_NAME'] . '</b> - ' . $news['NEWS_DATE'] . ' (';?>
                <?php $count = 0;?>

                <?php foreach ($news['SECTION'] as $section):?>
                    <?php if($count == 0):?>
                        <?php $info .= $section['NAME'];?>
                    <?php else:?>
                        <?php $info .= ', ' . $section['NAME'];?>;
                    <?php endif;?>
                    <?php $count++;?>
                <?php endforeach;?>

                <?php $info .= ')';?>
                <li> <?=$info;?></li>
                    <ul>
                        <?php foreach ($news['ELEMENTS'] as $elem):?>
                            <li> 
                                <?php echo $elem['NAME'] . ' - ' . $elem['PROPERTY_PRICE_VALUE'] . ' - ' . $elem['PROPERTY_MATERIAL_VALUE'] . ' - ' . $elem['PROPERTY_ARTNUMBER_VALUE'];?>
                            </li>
                        <?php endforeach;?>
                    </ul>
            <?php endforeach;?>
	    </ul>
    </div>