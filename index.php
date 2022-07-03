<?php
    $fileSourceURL = 'https://cdn.flashtalking.com/feeds/test_data/att_product_data.json';
    $fileBaseName = basename($fileSourceURL);
    $fileContents = file_get_contents($fileSourceURL);
    $fileForDisplay = json_decode($fileContents,true);

    $header = false;
    $arrayToPassForCSVing = [];

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
                                else {  //this cuts the two 1d things (I presume they are unwanted and unloved)
                                        $targetArray = [];//need a new array for each entry that can hold the stuff being pushed from the logic below, then that array needs to be pushed to the one being created for CSVing
                                    foreach($skuEntry as $singleSku => $skuEntryColumnHeading)
                                        {   $newSubTargetArray = [];
                                            
                                            //OKAY. so singleSku is the column heading ID. skuEntryColumnHeading is the data in each line, and some of these are still arrays
                                            if (!is_array($skuEntryColumnHeading))
                                            { 
                                                //echo '<br>2D column index: ' . $singleSku . '<br>';//all the data we need can be found here
                                                if($singleSku == 'mBrand' && $skuEntryColumnHeading != "Apple"){ // && brand !apple
                                                    //echo "this is an mbrand";
                                                    //if($skuEntryColumnHeading != "Apple"){
                                                        //echo ' this is not an apple device';
                                                        $tempmBrandArray = array('mBrand'=> $skuEntryColumnHeading);
                                                        
                                                      
                                                    //}
                                                } elseif($singleSku == 'skuDisplayName' ) {// and remove colour descriptions? 
                                                    //echo "this is a skudisplayname with the colour";
                                                    //use strrpos to find the position in the string of the last '-' in a variable
                                                    $lastHyphenInSkuDisplayNameLoc = strrpos($skuEntryColumnHeading,'-',-1);
                                                    //then use substr to cut the string at that location
                                                    $skuDisplayNameWithoutColour = substr($skuEntryColumnHeading,0,$lastHyphenInSkuDisplayNameLoc);
                                                    //echo $skuDisplayNameWithoutColour;//and then return this instead
                                                    
                                                    //use that 
                                                    $tempSkuDisplayNameArray = array('skuDisplayName' => $skuDisplayNameWithoutColour);
                                                    
                                                  

                                                } elseif ($singleSku == 'mPrice') {
                                                    //echo "this is an mprice";

                                                    $tempMPriceArray = array('mPrice' => $skuEntryColumnHeading);
                                                   

                                                } elseif ($singleSku == 'mListPrice') {
                                                    //echo "this is an mlisprice";

                                                    $tempMListPriceArray = array('mListPrice' => $skuEntryColumnHeading);
                                                    

                                                } elseif ($singleSku == 'mModel'){
                                                    //echo 'this is the model';

                                                    $tempMModelArray = array('mModel'=> $skuEntryColumnHeading);
                                                    
                                                   

                                                } elseif ($singleSku =='mLargeImage'){
                                                    //echo 'this is the image';

                                                    $tempMLargeImageArray = array('mLargeImage'=> $skuEntryColumnHeading);
                                                 

                                                } elseif ($singleSku == 'mId'){
                                                    //echo 'this is the mid';

                                                    $tempMIdArray = array('mId'=> $skuEntryColumnHeading);
                                                   

                                                } elseif ($singleSku == 'mProductPageURL'){
                                                   // echo 'mproductpageurl is this';

                                                    $tempProductPageURLArray = array('mProductPageURL'=> $skuEntryColumnHeading);
                                                    

                                                } elseif ($singleSku == 'mName') {
                                                   // echo 'this is the mname';

                                                    $tempmNameArray = array('mName'=> $skuEntryColumnHeading);
                                                    

                                                } elseif ($singleSku == 'salesRank') {
                                                    //echo 'this is the salesrank';
                                                    //so I just realised this should totally be a function
                                                    $tempSalesRankArray = array('salesRank'=>$skuEntryColumnHeading);
                                                    

                                                } elseif ($singleSku == 'mStarRatings'){
                                                    // "this is the mstarrating";

                                                    $tempmStarRatingsArray = array('mStarRatings'=> $skuEntryColumnHeading);
                                                    

                                                } elseif ($singleSku == 'mProductId') {
                                                    //echo 'this is hte mproductid';

                                                    $tempmProductIdArray = array('mProductId'=> $skuEntryColumnHeading);
                                                    

                                                } elseif ($singleSku == 'deviceType'){
                                                    //echo 'this is the devicetype';
                                                    
                                                    $tempDeviceTypeArray = array('deviceType'=> $skuEntryColumnHeading);
                                                    

                                                } elseif ($singleSku == 'mMobileProductPageURL'){
                                                    //echo 'this is the mobile product page url';

                                                    $tempmobileProductPageurlArray = array('mMobileProductPageURL'=> $skuEntryColumnHeading);
                                                    

                                                } elseif ($singleSku == 'mProductPageURLEs') {
                                                    //echo 'this is the product page urles';

                                                    $tempmProductPageURLEs = array('mProductPageURLEs'=> $skuEntryColumnHeading);
                                                    

                                                } elseif ($singleSku == 'mDescription'){
                                                    //echo 'this is the mdescription';

                                                    $tempMDescriptionArray = array('mDescription'=> $skuEntryColumnHeading);
                                                    

                                                } elseif ($singleSku == 'mDueToday'){
                                                    //echo ' this is the mduetoday';

                                                    $tempMDueTodayArray = array('mDueToday'=> $skuEntryColumnHeading);
                                                  

                                                } elseif ($singleSku == 'PDPPageURL'){
                                                    //echo 'this is the pdppageurl';

                                                    $tempPDPPageURLArray =array('PDPPageURL'=>$skuEntryColumnHeading);
                                                    
                                                    //so this is the array with all the things, however, it is not limited by
                                                    
                                                } else {
                                                   // echo 'dont want this';
                                                } 
                                                
                                                
                                               
                                            } 
                                            else 
                                                {
                                                    foreach($skuEntryColumnHeading as $skuSubCollumn => $skuSubColumnKey)
                                                    { $isSmartphone = false;
                                                        if(!is_array($skuSubColumnKey))
                                                        {
                                                            //echo "<br>3D sku subcolumn contents: " . $skuSubColumnKey;

                                                            if ($skuSubColumnKey == 'M-CAT-SMARTPHONES'){//so this is the category we want, and if we only add this it should automatically filter out tablets and wearables
                                                                 //echo 'this a smartphone';
                                                                 $isSmartphone = true;
                                                             }
                                                        } 
                                                        
                                                    } //var_dump($isSmartphone);
                                                }      
                                        } 

                                        $newSubTargetArray = $tempmBrandArray + $tempSkuDisplayNameArray +$tempMPriceArray + $tempMListPriceArray +$tempMModelArray+$tempMLargeImageArray +$tempMIdArray+$tempProductPageURLArray + $tempmNameArray +$tempSalesRankArray+$tempmStarRatingsArray+$tempmProductIdArray+$tempDeviceTypeArray+$tempmobileProductPageurlArray+$tempmProductPageURLEs+$tempMDescriptionArray+$tempMDueTodayArray+$tempPDPPageURLArray;
                                        var_dump($newSubTargetArray);//this can just be pushed into the big array?
                                        echo '<br><br>';
                                        
                                    }
                            }
                        }  
            }
            ?>
        </div>
    </body>
</html>