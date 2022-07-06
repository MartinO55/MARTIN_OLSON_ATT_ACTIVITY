<?php
    $fileSourceURL = 'https://cdn.flashtalking.com/feeds/test_data/att_product_data.json';
    $tempFileSource = 'C:\xampp\htdocs\MARTIN_OLSON_ATT_ACTIVITY\att_product_data.json';
    $fileBaseName = basename($fileSourceURL);
    $fileContents = file_get_contents($tempFileSource);
    $fileForDisplay = json_decode($fileContents,true);

    foreach($fileForDisplay as $key => $value){
        if(!is_array($value))
        { 
        } else {
                foreach($value as $sku => $skuEntry) 
                    {if (!is_array($skuEntry)) {echo 'You Should not be here';} 
                        else {  //this cuts the two 1d things (I presume they are unwanted and unloved)
                                
                            foreach($skuEntry as $singleSku => $skuEntryColumnHeading)
                                {   $newSubTargetArray = [];
                                     //OKAY. so singleSku is the column heading ID. skuEntryColumnHeading is the data in each line, and some of these are still arrays
                                    if (!is_array($skuEntryColumnHeading))
                                    { 
                                        //all the data we need can be found here
                                        if ($singleSku == 'mBrand'){ // && brand !apple                                        
                                            $tempmBrandArray = array('mBrand'=> $skuEntryColumnHeading);
                                            if($skuEntryColumnHeading == "Apple"){
                                               
                                                $tempmBrandArray = 'filthyAppleDevice';
                                            }
                                        } if ($singleSku === 'skuDisplayName') {
                                            $lastHyphenInSkuDisplayNameLoc = strrpos($skuEntryColumnHeading,'-',-1);
                                            
                                            $skuDisplayNameWithoutColour = substr($skuEntryColumnHeading,0,$lastHyphenInSkuDisplayNameLoc);
                                            
                                            $tempSkuDisplayNameArray = array('skuDisplayName' => $skuDisplayNameWithoutColour);   

                                        } if ($singleSku == 'mPrice') {

                                            $tempMPriceArray = array('mPrice' => $skuEntryColumnHeading);

                                        } if ($singleSku == 'mListPrice') {

                                            $tempMListPriceArray = array('mListPrice' => $skuEntryColumnHeading);

                                        } if ($singleSku == 'mModel'){

                                            $tempMModelArray = array('mModel'=> $skuEntryColumnHeading);
                                            
                                        } if ($singleSku =='mLargeImage'){

                                            $tempMLargeImageArray = array('mLargeImage'=> $skuEntryColumnHeading);

                                        } if ($singleSku == 'mId'){

                                            $tempMIdArray = array('mId'=> $skuEntryColumnHeading);
                                           
                                        } if ($singleSku == 'mProductPageURL'){
                                          

                                            $tempProductPageURLArray = array('mProductPageURL'=> $skuEntryColumnHeading);                  

                                        } if ($singleSku == 'mName') {
                                

                                            $tempmNameArray = array('mName'=> $skuEntryColumnHeading);
                                            
                                        } if ($singleSku == 'salesRank') {
                                       
                                            //so I just realised this should totally be a function
                                            $tempSalesRankArray = array('salesRank'=>$skuEntryColumnHeading);
                                            
                                        } if ($singleSku == 'mStarRatings'){
                                          

                                            $tempmStarRatingsArray = array('mStarRatings'=> $skuEntryColumnHeading);                                                 

                                        } if ($singleSku == 'mProductId') {
                                      

                                            $tempmProductIdArray = array('mProductId'=> $skuEntryColumnHeading);                                                  

                                        } if ($singleSku == 'deviceType'){
                                      
                                            
                                            $tempDeviceTypeArray = array('deviceType'=> $skuEntryColumnHeading);
                                            
                                        } if ($singleSku == 'mMobileProductPageURL'){
                                            
                                            $tempmobileProductPageurlArray = array('mMobileProductPageURL'=> $skuEntryColumnHeading);
                                            
                                        } if ($singleSku == 'mProductPageURLEs') {

                                            $tempmProductPageURLEs = array('mProductPageURLEs'=> $skuEntryColumnHeading);    

                                        } if ($singleSku == 'mDescription'){

                                            $tempMDescriptionArray = array('mDescription'=> $skuEntryColumnHeading);   

                                        } if ($singleSku == 'mDueToday'){

                                            $tempMDueTodayArray = array('mDueToday'=> $skuEntryColumnHeading);

                                        } if ($singleSku == 'PDPPageURL'){

                                            $tempPDPPageURLArray = array('PDPPageURL'=>$skuEntryColumnHeading);
                                            
                                            //so this is the array with all the things, however, it is not limited by
                                        } 
                                        
                                        else {
                                        }          
                                    } else 
                                        {   //$searchCatFor = "M-CAT-SMARTPHONES";
                                            
                                            if(array_search("M-CAT-SMARTPHONES",$skuEntryColumnHeading,true)){
                                               
                                                $tempSmartPhoneToggle = 'smartphone';
                                        
                                                
                                            } if (array_search("M-CAT-TABLETS",$skuEntryColumnHeading,true)){
                                                $tempSmartPhoneToggle = 'tablet';
                                            } if (array_search("Wearables",$skuEntryColumnHeading,true)){
                                                $tempSmartPhoneToggle = 'wearable';
                                            } 
                                               
                                            
                                            
                                            
                                            
                                        }      
                                }
                                $targetArray = [];//need a new array for each entry that can hold the stuff being pushed from the logic below, then that array needs to be pushed to the one being created for CSVing
                            if ($tempmBrandArray != 'filthyAppleDevice' && $tempSmartPhoneToggle == 'smartphone')
                            {
                                $newSubTargetArray = $tempmBrandArray + $tempSkuDisplayNameArray +$tempMPriceArray + $tempMListPriceArray +$tempMModelArray+$tempMLargeImageArray +$tempMIdArray+$tempProductPageURLArray + $tempmNameArray +$tempSalesRankArray+$tempmStarRatingsArray+$tempmProductIdArray+$tempDeviceTypeArray+$tempmobileProductPageurlArray+$tempmProductPageURLEs+$tempMDescriptionArray+$tempMDueTodayArray+$tempPDPPageURLArray;
                                
                                array_push($targetArray,$newSubTargetArray);
                                 }
                            
                            
                        }
                    }
                }  
    }
    $fp = fopen('C:\xampp\htdocs\MARTIN_OLSON_ATT_ACTIVITY\MARTIN_OLSON_ATT_ACTIVITY.csv','w');
                            
    foreach ($targetArray as $fields){
         fputcsv($fp,$fields);
     }
     fclose($fp);
    
    // //send csv file. So it turns out you dont have to do this in code. I'll comment this out but leave it for posterity     
    // $host ='flashtalking.exavault.com';
    // $port =21;
    // $user = 'japac_testing';
    // $secureport = 22;
    // $ftp_password = 'h8wDT*9D%L(H&4gw';
    // $file = 'C:\xampp\htdocs\MARTIN_OLSON_ATT_ACTIVITY\MARTIN_OLSON_ATT_ACTIVITY.csv';
    // $ftpServer = 'ftp://japac_testing:h8wDT*9D%L(H&4gw@flashtalking.exavault.com/';

    // $ftp = ftp_connect($host,22,90);
    // ftp_login($ftp,$user,$ftp_password);
    // echo 'upload commencing...<br><br>';

    // $ret = ftp_nb_put($ftp,'MARTIN_OLSON_ATT_ACTIVITY.csv',$file,FTP_BINARY,FTP_AUTORESUME);
    
    // while (FTP_MOREDATA == $ret){
    //     echo 'uploading...';
    //     $ret = ftp_nb_continue($ftp);
    // }
    // ftp_close($ftp);
    // echo '<br><br>upload complete :)';
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
        <a href="https://github.com/MartinO55/MARTIN_OLSON_ATT_ACTIVITY">Find the github link to this project here!</a>

        <?php
         foreach($fileForDisplay as $key => $value){
            if(!is_array($value))
            { 
            } else {
                    foreach($value as $sku => $skuEntry) 
                        {if (!is_array($skuEntry)) {echo 'You Should not be here';} 
                            else {  //this cuts the two 1d things (I presume they are unwanted and unloved)
                                    
                                foreach($skuEntry as $singleSku => $skuEntryColumnHeading)
                                    {   $newSubTargetArray = [];
                                         //OKAY. so singleSku is the column heading ID. skuEntryColumnHeading is the data in each line, and some of these are still arrays
                                        if (!is_array($skuEntryColumnHeading))
                                        { 
                                            //all the data we need can be found here
                                            if ($singleSku == 'mBrand'){ // && brand !apple                                        
                                                $tempmBrandArray = array('mBrand'=> $skuEntryColumnHeading);
                                                if($skuEntryColumnHeading == "Apple"){
                                                   
                                                    $tempmBrandArray = 'filthyAppleDevice';
                                                }
                                            } if ($singleSku === 'skuDisplayName') {
                                                $lastHyphenInSkuDisplayNameLoc = strrpos($skuEntryColumnHeading,'-',-1);
                                                
                                                $skuDisplayNameWithoutColour = substr($skuEntryColumnHeading,0,$lastHyphenInSkuDisplayNameLoc);
                                                
                                                $tempSkuDisplayNameArray = array('skuDisplayName' => $skuDisplayNameWithoutColour);   
    
                                            } if ($singleSku == 'mPrice') {
    
                                                $tempMPriceArray = array('mPrice' => $skuEntryColumnHeading);
    
                                            } if ($singleSku == 'mListPrice') {
    
                                                $tempMListPriceArray = array('mListPrice' => $skuEntryColumnHeading);
    
                                            } if ($singleSku == 'mModel'){
    
                                                $tempMModelArray = array('mModel'=> $skuEntryColumnHeading);
                                                
                                            } if ($singleSku =='mLargeImage'){
    
                                                $tempMLargeImageArray = array('mLargeImage'=> $skuEntryColumnHeading);
    
                                            } if ($singleSku == 'mId'){
    
                                                $tempMIdArray = array('mId'=> $skuEntryColumnHeading);
                                               
                                            } if ($singleSku == 'mProductPageURL'){
                                              
    
                                                $tempProductPageURLArray = array('mProductPageURL'=> $skuEntryColumnHeading);                  
    
                                            } if ($singleSku == 'mName') {
                                    
    
                                                $tempmNameArray = array('mName'=> $skuEntryColumnHeading);
                                                
                                            } if ($singleSku == 'salesRank') {
                                           
                                                //so I just realised this should totally be a function
                                                $tempSalesRankArray = array('salesRank'=>$skuEntryColumnHeading);
                                                
                                            } if ($singleSku == 'mStarRatings'){
                                              
    
                                                $tempmStarRatingsArray = array('mStarRatings'=> $skuEntryColumnHeading);                                                 
    
                                            } if ($singleSku == 'mProductId') {
                                          
    
                                                $tempmProductIdArray = array('mProductId'=> $skuEntryColumnHeading);                                                  
    
                                            } if ($singleSku == 'deviceType'){
                                          
                                                
                                                $tempDeviceTypeArray = array('deviceType'=> $skuEntryColumnHeading);
                                                
                                            } if ($singleSku == 'mMobileProductPageURL'){
                                                
                                                $tempmobileProductPageurlArray = array('mMobileProductPageURL'=> $skuEntryColumnHeading);
                                                
                                            } if ($singleSku == 'mProductPageURLEs') {
    
                                                $tempmProductPageURLEs = array('mProductPageURLEs'=> $skuEntryColumnHeading);    
    
                                            } if ($singleSku == 'mDescription'){
    
                                                $tempMDescriptionArray = array('mDescription'=> $skuEntryColumnHeading);   
    
                                            } if ($singleSku == 'mDueToday'){
    
                                                $tempMDueTodayArray = array('mDueToday'=> $skuEntryColumnHeading);
    
                                            } if ($singleSku == 'PDPPageURL'){
    
                                                $tempPDPPageURLArray = array('PDPPageURL'=>$skuEntryColumnHeading);
                                                
                                                //so this is the array with all the things, however, it is not limited by
                                            } 
                                            
                                            else {
                                            }          
                                        } else 
                                            {   //$searchCatFor = "M-CAT-SMARTPHONES";
                                                
                                                if(array_search("M-CAT-SMARTPHONES",$skuEntryColumnHeading,true)){
                                                   
                                                    $tempSmartPhoneToggle = 'smartphone';
                                            
                                                    
                                                } if (array_search("M-CAT-TABLETS",$skuEntryColumnHeading,true)){
                                                    $tempSmartPhoneToggle = 'tablet';
                                                } if (array_search("Wearables",$skuEntryColumnHeading,true)){
                                                    $tempSmartPhoneToggle = 'wearable';
                                                } 
                                                   
                                                
                                                
                                                
                                                
                                            }      
                                    }
                                    $targetArray = [];//need a new array for each entry that can hold the stuff being pushed from the logic below, then that array needs to be pushed to the one being created for CSVing
                                   
                                    if ($tempmBrandArray != 'filthyAppleDevice' && $tempSmartPhoneToggle == 'smartphone')
                                {
                                    $newSubTargetArray = $tempmBrandArray + $tempSkuDisplayNameArray +$tempMPriceArray + $tempMListPriceArray +$tempMModelArray+$tempMLargeImageArray +$tempMIdArray+$tempProductPageURLArray + $tempmNameArray +$tempSalesRankArray+$tempmStarRatingsArray+$tempmProductIdArray+$tempDeviceTypeArray+$tempmobileProductPageurlArray+$tempmProductPageURLEs+$tempMDescriptionArray+$tempMDueTodayArray+$tempPDPPageURLArray;
                                    
                                   
                                    //fputcsv($fp,$newSubTargetArray);

                                    array_push($targetArray,$newSubTargetArray);
                                }
                                $fp = fopen('C:\xampp\htdocs\MARTIN_OLSON_ATT_ACTIVITY\MARTIN_OLSON_ATT_ACTIVITY.csv','a');
                            
                                foreach ($targetArray as $fields){
                                     fputcsv($fp,$fields);
                                 }

                                 fclose($fp);
                                     var_dump($targetArray);
                            
                                     
                                  
                            }
                        }
                    }  
        }   

        ?>
        </div>
    </body>
</html>