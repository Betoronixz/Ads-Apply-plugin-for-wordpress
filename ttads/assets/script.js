jQuery(document).ready(function () {
  jQuery(".section").hide(); // Hide all sections initially
  jQuery("#setup-details").show(); // Show the initial section

  // Handle clicks on the menu items
  jQuery(".list-items li a").click(function (e) {
    e.preventDefault();
    jQuery(".section").hide(); // Hide all sections
    var target = jQuery(this).data("target"); // Get the target section ID
    jQuery(target).show(); // Show the target section
  });
});

function updatecost() {
  const dropdownElement = document.getElementById("wtp");
const costElement = document.getElementById("ttcost1");
const selectedOption = dropdownElement.value;
const wtp1w=document.getElementById("c1").textContent;
const wtp1m=document.getElementById("c2").textContent;
const wtp1y=document.getElementById("c3").textContent;

  if (selectedOption === "1w") {
    costElement.textContent = wtp1w;
  }
  else if(selectedOption === "1m"){
    costElement.textContent = wtp1m;
   }
   else if(selectedOption === "1y"){
    costElement.textContent = wtp1y;
     }
     else{
      costElement.textContent = 0;

     }
}

function updatecost2() {
  const dropdownElement = document.getElementById("wfp");
const costElement = document.getElementById("ttcost2");
const selectedOption = dropdownElement.value;
const wfp1w=document.getElementById("c4").textContent;
const wfp1m=document.getElementById("c5").textContent;
const wfp1y=document.getElementById("c6").textContent;

  if (selectedOption === "1w") {
    costElement.textContent = wfp1w;
  }
  else if(selectedOption === "1m"){
    costElement.textContent = wfp1m;
   }
   else if(selectedOption === "1y"){
    costElement.textContent = wfp1y;
     }
     else{
      costElement.textContent = 0;

     }
}



function updatecost3() {
  const dropdownElement = document.getElementById("yt");
const costElement = document.getElementById("ttcost3");
const selectedOption = dropdownElement.value;
const yt3s=document.getElementById("c7").textContent;
const yt60s=document.getElementById("c8").textContent;

  if (selectedOption === "1w") {
    costElement.textContent = yt3s;
  }
  else if(selectedOption === "1m"){
    costElement.textContent = yt60s;
   }
     else{
      costElement.textContent = 0;

     }
}

function updatecost4() {
  const dropdownElement = document.getElementById("ap");
const costElement = document.getElementById("ttcost4");
const selectedOption = dropdownElement.value;
const ap1w=document.getElementById("c9").textContent;
const ap1m=document.getElementById("c10").textContent;
const ap1y=document.getElementById("c11").textContent;

  if (selectedOption === "1w") {
    costElement.textContent = ap1w;
  }
  else if(selectedOption === "1m"){
    costElement.textContent = ap1m;
   }
   else if(selectedOption === "1y"){
    costElement.textContent = ap1y;
     }
     else{
      costElement.textContent = 0;

     }
}

function updatecost5() {
  const dropdownElement = document.getElementById("fb");
const costElement = document.getElementById("ttcost5");
const selectedOption = dropdownElement.value;
const fb1w=document.getElementById("c12").textContent;
const fb1m=document.getElementById("c13").textContent;
const fb1y=document.getElementById("c14").textContent;

  if (selectedOption === "1w") {
    costElement.textContent = fb1w;
  }
  else if(selectedOption === "1m"){
    costElement.textContent = fb1m;
   }
   else if(selectedOption === "1y"){
    costElement.textContent = fb1y;
     }
     else{
      costElement.textContent = 0;

     }
}

