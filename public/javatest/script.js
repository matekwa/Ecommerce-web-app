//Getting all requirerd elements
    const searchWrapper = document.querySelector(".box");
    const inputBox = searchWrapper.querySelector("input");
    const suggBox = searchWrapper.querySelector(".autocom-box");

//If user presses any key
    inputBox.onkeyup = (e)=>{
        let userData;
        userData = e.target.value;
        let emptyArray = [];
        if (userData){
            emptyArray = suggestions.filter((data)=>{
                return data.toLocaleLowerCase().startsWith(userData.toLocaleLowerCase());
            });
            emptyArray = emptyArray.map((data) =>{
                return data = '<li>'+data+'</li>';
            });
            console.log(emptyArray);
            searchWrapper.classList.add("active");
            showSuggestions(emptyArray);
            let allList = suggBox.querySelectorAll("li");
            for (let i =0; i < allList.length; i++) {
                //adding onclick on li tags
                allList[i].setAttribute("onclick","select(this)");
            }
        } else{
             searchWrapper.classList.remove("active");
        }
         
    }
    function select(element){
        let selectUserData = element.textContent;
        inputBox.value = selectUserData;
        searchWrapper.classList.remove("active");
        suggestions.push(selectUserData);
        for (var i = 0; i < suggestions.length; i++) {
            console.log(suggestions[i]);
        }
            let search_result = myAjax("POST", "../resources/search.php");
            search_result.onreadystatechange = function()
            {
                if (ajaxStatus(search_result) == true){
                    window.location = "category.php?id="+search_result.responseText;
                }
            }
            search_result.send("s="+selectUserData);
    }

    function showSuggestions(list) {
        let listData;
        if (!list.length) {
          let  userValue = inputBox.value;
            listData = '<li>'+userValue+'</li>';
        } else{
            listData = list.join('');
        }
        suggBox.innerHTML = listData;
    }