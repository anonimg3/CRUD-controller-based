function validation(){  
    let inputArray = document.getElementsByClassName('inputValue');
    let correct = true;

    for(let i = 0; i < inputArray.length; i++ ){
        if( inputArray[i].value.trim().length < 3 ){
            inputArray[i].placeholder = "Pole nie może być puste";
            inputArray[i].style.borderColor = "red";
            inputArray[i].classList.toggle("apply-shake");
            correct = false;
        }else{
            inputArray[i].style.borderColor = "#a5cda5"; 
        }
    }
    return correct;    
}

