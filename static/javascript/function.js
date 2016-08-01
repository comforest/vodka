var prevKey;

/* sortJson
*   param : json - 배열
*           key - 정렬 기준인 key
*           func - 배열 후 실행 할 함수
*/
function sortJson(json, key){
    if(prevKey == key){
        prevKey ="";
        json = mergeSort(json, key, -1);
    }else{
        prevKey = key;
        json = mergeSort(json, key, 1);
    }
    return json;
}


/* mergeSort & merge
*	param : arr - json Array
*			key - json Array에서 비교할 key
*			s - 1 오름차순, -1 내림차순
*	retrun : 정렬된 배열
*/
function mergeSort(arr, key,s){
    if (arr.length < 2)
        return arr;

    var middle = parseInt(arr.length / 2);
    var left   = arr.slice(0, middle);
    var right  = arr.slice(middle, arr.length);

    return merge(mergeSort(left,key,s), mergeSort(right,key,s),key,s);
}
function merge(left, right, key,s){
    var result = [];

    while (left.length && right.length) {
        if (left[0][key].localeCompare(right[0][key])*s <= 0) {
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