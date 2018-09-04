/**
  Block undesirable characters
  @param lockType lock type that will applied over keys pressed
  @param keyEvent Key pressed from user
  @return false When it find undesirable character
*/
function lockType(lockType, keyEvent){

  // Verify if access to page is across the Internet Explorer to get char code using specific method
  if (window.Event) {// Access across IE
    var char = keyEvent.charCode;
  }else{// Another browser
    var char = keyEvent.which;
  }

  // Apply lock for numbers
  if (lockType == "number") {

    // Verify char code, if it equals numbers
    if (char >= 48 && char <= 57) {
      return false;
    }

  }else if(lockType == "char"){ // Apply lock for characters

    // Verify char code, if it equals letters
    if (char <= 47 || char >= 58) {
      return false;
    }

  }

}
