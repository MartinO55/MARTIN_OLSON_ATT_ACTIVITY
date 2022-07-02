<?php
    $fileSourceURL = 'https://cdn.flashtalking.com/feeds/test_data/att_product_data.json';
    $fileBaseName = basename($fileSourceURL);
    $fileContents = file_get_contents($fileSourceURL);
    $fileForDisplay = json_decode($fileContents,true);

    $header = false;

?>

<!DOCTYPE html>

<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title></title>
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="">
    </head>
    <body>
        <div>
        <a href="https://cdn.flashtalking.com/feeds/test_data/att_product_data.json">File here</a>
        </div>
        <div>
            <?php
            foreach($fileForDisplay as $key => $value){
                if(!is_array($value))
                { 
                    echo '<br>1D object index: ' . $key . '<br>';
                }
                    else {
                            foreach($value as $sku => $skuEntry) 
                            {if (!is_array($skuEntry)) {echo 'You Should not be here';} 
                                else {
                                    foreach($skuEntry as $singleSku => $skuEntryColumnHeading)
                                        {//OKAY. so singleSku is the column heading ID. skuEntryColumnHeading is the data in each line, and some of these are still arrays
                                            if (!is_array($skuEntryColumnHeading))
                                            {
                                                echo '<br>2D column index: ' . $singleSku . '<br>';
                                            } 
                                            else 
                                                {
                                                    foreach($skuEntryColumnHeading as $skuSubCollumn => $skuSubColumnKey)
                                                    {
                                                        if(!is_array($skuSubColumnKey))
                                                        {
                                                            echo "<br>3D sku subcolumn contents: " . $skuSubColumnKey;
                                                        } else 
                                                            {
                                                                foreach($skuSubColumnKey as $skuSubColumnEntry => $skuSubSubColumnKey)
                                                                {
                                                                    if (!is_array($skuSubSubColumnKey))
                                                                    {
                                                                        echo "<br>4D sku Sub Sub Column Contents: " . $skuSubSubColumnKey;
                                                                    } else 
                                                                        {
                                                                            foreach ($skuSubSubColumnKey as $sku5DColumnEntry => $sku5DColumnKey) {
                                                                               echo "<br> 5d Column contents: " . $sku5DColumnKey;//So we could keep extending this algorithm for another 2 or 3 dimensions I think, but we are just dropping that data anyway so I don't think we need to
                                                                            }
                                                                        }
                                                                
                                                                }
                                                            }
                                                        
                                                    }
                                                }      
                                        }
                                    }
                            }
                        }  
            }
             

            ?>
        </div>
    </body>
</html>