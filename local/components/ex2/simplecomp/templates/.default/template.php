<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<div>
    <h3> Выбранных новостей: <?=$arResult['NEWS_COUNT'];?></h3>
    <ul>
        Авторы и новости
        <?php foreach ($arResult['VALID_AUTHORS'] as $author):?>  
            <li> <?=$author['LOGIN'];?></li>
                <ul>
                    <?php foreach ($arResult['NEWS_BY_AUTHORS'][$author['ID']] as $element):?>
                        <li> 
                            <?=$element['NAME'];?>
                        </li>
                    <?php endforeach;?>
                </ul>
        <?php endforeach;?>
    </ul>
</div>
</pre>