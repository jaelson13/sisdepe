let localUser;
if(localStorage.getItem(`${window.btoa('user')}`)){
   localUser = JSON.parse(window.atob(localStorage.getItem(`${window.btoa('user')}`)));  
}else{  
   document.cookie = "isLogging=;expires=Thu, 01 Jan 1970 00:00:01 GMT;";
}

export default localUser;