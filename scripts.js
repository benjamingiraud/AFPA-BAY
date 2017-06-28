var taskObjects = [];
$(document).ready(function() {

  //-------localStorage parsing--------//
  if (localStorage.length && localStorage[0] == "tasks") {
    taskObjects = JSON.parse(localStorage.getItem("tasks"));
    for (var i = 0; i < taskObjects.length; i++) {
      addTask(taskObjects[i].content);
    }
  }
  //------Endof localStorage parsing------//
  //------Startof Animations-------//
  $(".title").fadeIn("5000");

  $(".film-container").fadeIn("1000");

  $("button.collapse").click(function() {
    $(this).toggleClass("active");
    $(this).next().slideToggle("1500");
  });
  $("button.menu-collapse").click(function() {
    $(this).next().slideToggle("1000");
  });
  //------Endof Animations-------//
  // "+" button add a task if clicked
  $("#send").click(function() {
    var task = $("#new").val();
    if(!$.trim(task).length) // trim the value and check it's length to make sure this isn't empty
      return; // if it is, exit the function
    addTask($.trim(task)); // else we add the task to the todolist
  });

  $(".favorite").hover(function() {
    $(this).val('\uf004');
    },
    function() {
      $(this).val('\uf08a');
  });
  $(".rateup").hover(function() {
    $(this).val('\uf165');
    $(this).prev().css("opacity", "0.5");
    },
    function() {
      $(this).val('\uf088');
      $(this).prev().css("opacity", "1");
  });
  $(".ratedown").hover(function() {
    $(this).val('\uf164');
    $(this).next().css("opacity", "0.5");
    },
    function() {
      $(this).val('\uf087');
      $(this).next().css("opacity", "1");
  });

})
function addTask(task) {
  // Set the text input's value to null
  $("#new").val("");

  //-------Startof div's task creation content--------//
  var newDiv = $("<div></div>");
  //var indexInput = $('<input></input>').attr('maxlength', '2').attr('size', '2');
  var editBtn = $('<button></button>').text('\uf0ad');
  var newP = $("<input></input>").val(task);
  var delBtn = $("<button></button>").text('\uf00d');
  var moveDown = $("<button></button>").text('\uf063');
  var moveUp = $("<button></button>").text('\uf062');
  //-------Endof div's task creation content--------//
  //-------Startof content's attributes declaration--------//
  newDiv.addClass("task");
  //indexInput.addClass('index');
  editBtn.addClass("toggle");
  newP.addClass("taskvalue");
  newP.attr('disabled', 'disabled');
  delBtn.addClass("destroy");
  moveUp.addClass("deplaceU");
  moveDown.addClass("deplaceD");
  //-------Endof content's attributes declaration--------//
  //-------Startof pushing content to the task container--------//
  //newDiv.append(indexInput);
  newDiv.append(editBtn);
  newDiv.append(newP);
  newDiv.append(delBtn);
  newDiv.append(moveDown);
  newDiv.append(moveUp);
  newDiv.hide(); // We hide the fresh created div...
  $("#list-container").append(newDiv); // ...we put it in the task container..
  //indexInput.val(newDiv.index());
  $(".task").fadeIn("slow"); // ...and add a effect to make it appears slowly.
  //-------Endof pushing content to the task container--------//

}
$(document).on("click", ".destroy", function() { $(this).parent().remove(); });

$(document).on("click", ".deplaceU", function() {

  if ($(this).parent().is(':first-child') & $(this).parent().is(':not(:only-child)')) {
    var taskCopy = $(this).parent().clone().hide();
    $(this).parent().remove();
    $('#list-container').append(taskCopy);
    taskCopy.fadeIn('fast');
  }

  $(this).parent().hide();
  $(this).parent().insertBefore($(this).parent().prev());
  $(this).parent().fadeIn('fast');

});

$(document).on("click", ".deplaceD", function() {

  if ($(this).parent().is(':last-child') & $(this).parent().is(':not(:only-child)')) {
    var taskCopy = $(this).parent().clone().hide();
    $(this).parent().remove();
    $('#list-container').prepend(taskCopy);
    taskCopy.fadeIn('fast');
  }
  $(this).parent().hide();
  $(this).parent().insertAfter($(this).parent().next());
  $(this).parent().fadeIn('fast');

});

/* function appelée lorsque l'on appuie sur le
** bouton "edit", qui permet d'éditer la tâche.
*/
$(document).on("click", ".toggle", function() {

  if ($(":button").hasClass("check")) {
    var wasEditing = $(".check");
    wasEditing.next().attr('disabled', 'disabled');
    wasEditing.removeClass("check");
    wasEditing.addClass("toggle");
    wasEditing.text('\uf0ad');
  }
  $(this).next().removeAttr('disabled'); // On enlève l'attribut 'disabled' de l'input qui rendait impossible d'éditer
  $(this).next().focus();
  $(this).removeClass('toggle'); // On enlève la classe "toggle"...
  $(this).addClass('check'); // ... et on y ajoute la classe "check" afin que ce soit l'autre fonction qui soit appelée
  $(this).text('\uf00c'); // On change donc le texte du bouton en conséquence.

});

/* function appelée lorsque l'on appuie sur le
** bouton "check" (précédemment édit), qui rend
** impossible d'éditer le contenu.
*/
$(document).on("click", ".check", function() {

  $(this).next().attr('disabled', 'disabled');
  $(this).removeClass('check');
  $(this).addClass('toggle');
  $(this).text('\uf0ad');

  if ($(this).next().val() == "") {
    $(this).parent().remove();
  }

});

$(document).on("click", ".save", function() {

  localStorage.clear();
  taskObjects.length = 0;

  $(".taskvalue").each(function() {
    var toDoObj = {
      content : $(this).val(),
      id : $(this).parent().index()
    }
    taskObjects.push(toDoObj);
  });

  var objectsToString = JSON.stringify(taskObjects);
  localStorage.setItem("tasks", objectsToString);

});

$(document).on("click", ".clear", function() {

  $(".task").each(function() {
    $(this).remove();
  })
});

var add = (function () {
    var counter = 0;
    return function () {return counter += 1;}
})();
