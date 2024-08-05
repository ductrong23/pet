const banner_index=document.getElementsByClassName("banner_index")

let i = 0;
setInterval(()=>{
let currentActive = document.querySelector(".active");
currentActive.classList.remove("active");
i++;
if(i === 4){
    i = 0;
}
banner_index[i].classList.add("active");
},2000)