<?php

// if(isset($_POST['submit'])){
//     $word = str_split($_POST['text']);

//     $bracket_array = [];

//     foreach($word as $check){
//         if($check == '(' || $check == '[' || $check == '{'){
//             array_push($bracket_array, $check);
//         }
//         if($check == ')' || $check == ']' || $check == '}'){
//             if(empty($bracket_array)){
//                 print("Not valid");
//             }

//             $opening_bracket = array_pop($bracket_array);

//             if($check == ')' && $opening_bracket != '(' || $check == ']' && $opening_bracket != '['  || $check == '}' && $opening_bracket != '{' ){
//                 print("Not valid!");
//             }

//         }

//     }

//     if(empty($bracket_array)){
//         echo("Valid");
//     }
//     else {
//         echo("Not valid");
//     }
// }


function check_valid($word){
    $input = str_split($word);

    $bracket_array = [];

    foreach ($input as $check) {
        if ($check == '(' || $check == '[' || $check == '{') {
            array_push($bracket_array, $check);
        }
        if ($check == ')' || $check == ']' || $check == '}') {
            if (empty($bracket_array)) {
                echo ("Invalid");
                return false;
            }

            $opening_bracket = array_pop($bracket_array);

            if ($check == ')' && $opening_bracket != '(' || $check == ']' && $opening_bracket != '['  || $check == '}' && $opening_bracket != '{') {
                echo ("Invalid");
                return false;
            }
        }

    }

    if(empty($bracket_array)){
        echo("Valid");
        return true;
    }
    else {
        echo("Not valid");
        return false;
    }
}

check_valid("[(()}]");