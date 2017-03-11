var json, json_all;
var sarr = new Array();
var afterFunction = function(){};
var rankList = ["해","달","별","구름",""];


function setAfterFunction(func){
    afterFunction = func;
}

function addKeyList(key, value){
    sarr[ key ] = value;
}

function getData(url){
    $.ajax({
        url:url,
        type:'post',
        success:function(data){
            json_all = json = data;
            writeList();
        },
        error: function (request, status, error) {
            console.log('code: '+request.status+"\n"+'message: '+request.responseText+"\n"+'error: '+error);
        }
    });
}


function writeList(){

    var str = "";
    str +=  "<thead>";
    str +=  "<tr>";
    for(key in json[0]){
        if(sarr[key] != null)
            str += "<th id=\""+key+"\">"+sarr[key]+"</th>";
    }
    str +=  "</tr>";
    str +=  "</thead>";
    str +=  "<tbody>";
    for(i in json){
        str+="<tr>";
        $.each(json[i],function(key,value){
            if(value==null){
                json[i][key] = '';
                value='';
            }
            if(sarr[key] != null){
                if(key=="rank"){
                    value=rankList[value-1];
                }
                str+="<td>"+value+"</td>";  
            }
        });
        str+="</tr>";
    }
    str +=  "</tbody>";

    $("#sortTable").html(str);


    for(key in json[0]){
        $("#"+key).click(function(){
            json = sortJson(json, $(this).attr('id'));
            writeList();
        });
    }

    afterFunction();
}



var prevKey;

/* sortJson
*   param : json - 배열
*           key - 정렬 기준인 key
*           func - 배열 후 실행 할 함수
*/
function sortJson(json, key){
    var f = function(a,b){
        return Number(a) < Number(b);
    };

    for(i in json){
        if(isNaN(json[i][key]) == true){
            f = function(a,b){
                return a.localeCompare(b) <= 0;
            };
            break;
        }
    }


    if(prevKey == key){
        prevKey ="";
        json = mergeSort(json, key, function(a,b){f(b,a);});
    }else{
        prevKey = key;
        json = mergeSort(json, key, f);
    }
    return json;
}


/* mergeSort & merge
*	param : arr - json Array
*			key - json Array에서 비교할 key
*			f - 정렬 기준 함수
*	retrun : 정렬된 배열
*/
function mergeSort(arr, key,f){
    if (arr.length < 2)
        return arr;

    var middle = parseInt(arr.length / 2);
    var left   = arr.slice(0, middle);
    var right  = arr.slice(middle, arr.length);

    return merge(mergeSort(left,key,f), mergeSort(right,key,f),key,f);
}
function merge(left, right, key,f){
    var result = [];

    while (left.length && right.length) {
        if (f(left[0][key],right[0][key])) {
            result.push(left.shift());
        } else {
            result.push(right.shift());
        }
    }

    while (left.length)
        result.push(left.shift());

    while (right.length)
        result.push(right.shift());

    return result;
}