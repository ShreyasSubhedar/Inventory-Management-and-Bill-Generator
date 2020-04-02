function validateform1(){  
    var name =document.myform.cat_title.value;  
      
    if ((name==null || name=="")){  
      alert("Name can't be blank");  
      return false;  
    }
    }
    function validateform2(){  
    var name =document.myform.cat_update.value;  
    if ((name==null || name=="")){  
      alert("Name can't be blank");  
      return false;  
    }
    }  