//var Memory = 0; //set score to 0
//var Focus = 0;
var logic = 0;
var math = 0;
//var Agility = 0;
var total = 10; //total number of questions
var point = 2; //points per correct answer
var highest = total * point;

//initializser
function init(){
  //set correct answers
  sessionStorage.setItem('a1','b');
  sessionStorage.setItem('a2','c');
  sessionStorage.setItem('a3','d');
  sessionStorage.setItem('a4','c');
  sessionStorage.setItem('a5','c');
  sessionStorage.setItem('a6','b');
  sessionStorage.setItem('a7','c');
  sessionStorage.setItem('a8','a');
  sessionStorage.setItem('a9','b');
  sessionStorage.setItem('a10','c');

}

$(document).ready(function(){
  //hide all questions
  $('.questionForm').hide();
  $('#results').hide();

  //show introduction
  $('#introduction').show();

  //show first question
  $('#introduction a').on('click', function(){
    $('#introduction').hide();
    $('#q1').show();
  });

  $('.questionForm #submit').click(function(){
    //Get data attributes
    current = $(this).parents('form:first').data('question');
    next = $(this).parents('form:first').data('question')+1;
    //Hide all questions
    $('.questionForm').hide();
    //Show next questions
    $('#q'+next+'').fadeIn(300);
    process(''+current+'');
    return false;
    });
});

//process the answers
function process(n){
  //Get input value
  var submitted = $('input[name=q'+n+']:checked').val();
  if(n<=6){
    if(submitted == sessionStorage.getItem('a'+n+'')){
          logic = logic + 1;
    }
  }
  else if (6<n<11) {
    if(submitted == sessionStorage.getItem('a'+n+'')){
          math = math + 2;
    }
  }

  if(n == total){
      document.cookie = 'logic='+logic;
      document.cookie = 'math='+math;

      window.location.href="result.php";
  }
  return false;
}

//Add event listener
window.addEventListener('load',init,false);
