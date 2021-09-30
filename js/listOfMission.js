const listOfMission = document.getElementById('listOfMission');
let missionDetailElements = document.getElementsByClassName('missionDetailElements');
let missionDetailTitle = document.getElementsByClassName('missionDetailTitle');

let obj;
let detailObj;
let id;

const ajaxReq = new XMLHttpRequest();
ajaxReq.open('GET', '../front/getDataTitleMission.php');

ajaxReq.onload = function (){
    let result = ajaxReq.responseText;
    obj = JSON.parse(result);
    for(let i = 0; i <= Object.keys(obj).length; i++){
        let a = document.createElement('a');
        a.className = ('list-group-item linkMission');
        let objIndex = obj[i];
        for(let key in objIndex){
            let insertValue = document.createTextNode(objIndex[key].toString());
            a.appendChild(insertValue);
            listOfMission.appendChild(a);

            a.addEventListener('click', () => {
                let  detailAjaxReq = new XMLHttpRequest();
                detailAjaxReq.open('GET', '../front/getDetailDataMission.php?title='+objIndex[key]);
                for(let z=0; z<missionDetailElements.length; z++){
                    missionDetailElements[z].innerHTML = "";
                }

                detailAjaxReq.onload = function (){
                    let detailResult = detailAjaxReq.responseText;
                    detailObj = JSON.parse(detailResult);
                    console.log(detailObj);
                    for(let y = 0; y <= Object.keys(detailObj).length; y++){

                        let j = 0;
                        let objIndexDetail = detailObj[y];


                        for(let key2 in objIndexDetail){
                            if(objIndexDetail[key2] !== objIndexDetail['id_require_speciality']) {
                                let insertValue = document.createTextNode(objIndexDetail[key2].toString());
                                missionDetailElements[j].appendChild(insertValue);
                                j++;
                            }else{
                                id = objIndexDetail[key2];
                                let innner = getId(id);
                                console.log(missionDetailElements[6])
                                missionDetailElements[j].innerHTML = innner;
                                j++;
                            }

                            for(let z=0; z<missionDetailElements.length; z++){
                                missionDetailElements[z].style.display = 'block';
                                missionDetailTitle[z].style.display = 'block';
                            }
                        }
                        missionDetailElements[0].style.display = 'none';
                        missionDetailTitle[0].style.display = 'none';
                    }
                }
                detailAjaxReq.send();
            })
        }
    }
};
ajaxReq.send();

for(let z=0; z<missionDetailElements.length; z++){
    missionDetailElements[z].style.display = 'none';
    missionDetailTitle[z].style.display = 'none';
}

function getId(id){
    //Get Name of speciality with the ID
    let idSpeciality;
    let requireSpeAjax = new XMLHttpRequest();
    requireSpeAjax.open('GET', '../front/getDataIdSpecality.php?id='+id, false);
    requireSpeAjax.onload = function (){
        let result = requireSpeAjax.responseText;
        idSpeciality = JSON.parse(result);
    }
    requireSpeAjax.send();
    return idSpeciality[0]['name'];
}