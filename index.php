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
                                                echo '<br>2D column index: ' . $singleSku . '<br>';//all the data we need can be found here
                                                if($singleSku == 'mbrand'){ // && brand !apple
                                                    echo "this is an mbrand";
                                                } elseif($singleSku == 'skudisplayname') {
                                                    echo "this is a skudisplayname";
                                                } elseif ($singleSku == 'mprice') {
                                                    echo "this is an mprice";
                                                } elseif ($singleSku == 'mlistprice') {
                                                    echo "this is an mlisprice";
                                                } elseif ($singleSku == 'model'){
                                                    echo 'this is the model';
                                                } elseif ($singleSku =='mlargeimage'){
                                                    echo 'this is the image';
                                                } elseif ($singleSku == 'mid'){
                                                    echo 'this is the mid';
                                                } elseif ($singleSku == 'mproductpageurl'){
                                                    echo 'mproductpageurl is this';
                                                } elseif ($singleSku == 'mname') {
                                                    echo 'this is the mname';
                                                } elseif ($singleSku == 'salesrank') {
                                                    echo 'this is the salesrank';
                                                } elseif ($singleSku == 'mstarratings'){
                                                    echo "this is the mstarrating";
                                                } elseif ($singleSku == 'mproductid') {
                                                    echo 'this is hte mproductid';
                                                } elseif ($singleSku == 'devicetype'){
                                                    echo 'this is the devicetype';
                                                } elseif ($singleSku == 'mmobileproductpageurl'){
                                                    echo 'this is the mobile product page url';
                                                } elseif ($singleSku == 'mproductpageurles') {
                                                    echo 'this is the product page urles';
                                                } elseif ($singleSku == 'mdescription'){
                                                    echo 'this is the mdescription';
                                                } elseif ($singleSku == 'mduetoday'){
                                                    echo ' this is the mduetoday';
                                                } elseif ($singleSku == 'pdppageurl'){
                                                    echo 'this is the pdppageurl';
                                                } else {
                                                    return;
                                                }
                                                
                                            } 
                                            else 
                                                {
                                                    foreach($skuEntryColumnHeading as $skuSubCollumn => $skuSubColumnKey)
                                                    {
                                                        if(!is_array($skuSubColumnKey))
                                                        {
                                                            echo "<br>3D sku subcolumn contents: " . $skuSubColumnKey;

                                                            // if ($skuSubColumnKey == 'M-CAT-SMARTPHONES'){
                                                            //     echo 'this a smartphone';
                                                            // }
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