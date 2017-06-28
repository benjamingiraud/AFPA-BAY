$(document).ready(function() {
  $("#game").focus(function() {
    startGame();
  });
});

function startGame() { //fonction lancée lorsque la page a fini de charger
  myHero = new Component("player", 100, 30, 30, "black", 400-30, 600-30, 4, 0); //Création du joueur
  myEnnemies = [];//Tableau de futurs ennemis;
  myProjectiles = [];//Tableau de futurs projectiles lancé par le jour
  myGameArea.start();//On entre dans la fonction principale
}
var myGameArea = {
  canvas : document.getElementById("game"), //on récupère le canvas
  start : function() {
    this.canvas.addEventListener("keydown", action, false);
    this.score = 0;
    this.context = this.canvas.getContext("2d");
    this.ennemies = setInterval(createEnnemy, Math.floor((Math.random()*250)+750));
    this.interval = setInterval(updateGameArea, 5);
    this.interval = setInterval(updateInfo, 1000);
  },
  info : function() {
  },
  clear : function() {
    this.context.clearRect(0, 0, this.canvas.width, this.canvas.height);
  },
  pause : function() {

  },
  over : function() {

  }
}
function createEnnemy() {
  var random_x = Math.floor(Math.random()*770);
  ennemy = new Component("ennemy", 50, Math.floor((Math.random()*50)+20),  Math.floor((Math.random()*50)+20), 'black', random_x, 0, 0, Math.floor((Math.random()*2)+1));
  myEnnemies.push(ennemy);
}
function Component(type, health, width, height, color, x, y, speed_x, speed_y) {
  this.cooldown = 15;
  this.type = type;
  this.health = health;
  this.width = width;
  this.height = height;
  this.x = x;
  this.y = y;
  this.speed_x = speed_x;
  this.speed_y = speed_y;
  this.dead = false;
  this.color = color;

  this.update = function() {
    ctx = myGameArea.context;

    if (this.health <= 0) {
      this.dead = true;
      return;
    }

  	ctx.fillStyle = this.color;

    if (this.cooldown) {
      this.cooldown--;
    }

  	if (this.type == "player") {
      if (this.x > 0 && this.x < myGameArea.canvas.width - this.width) {
        this.x += this.speed_x;
  		} else {
  		  this.speed_x *= -1;
  		  this.x += this.speed_x;
  		}
  	} else {
  		  this.y += this.speed_y;
  	}

  	ctx.fillRect(this.x, this.y, this.width, this.height);
  }
}
function areColliding(firstComponent, secondComponent) {
  var rect1 = firstComponent;
  var rect2 = secondComponent;

  if (rect1.x < rect2.x + rect2.width &&
      rect1.x + rect1.width > rect2.x &&
      rect1.y < rect2.y + rect2.height &&
      rect1.height + rect1.y > rect2.y) {
        return true;
  } else return false;
}
function updateInfo() {
  myGameArea.score += 5;
}
function updateGameArea() {
  if (myHero.health > 0) {
  myGameArea.clear();
  myGameArea.context.font = "30px Arial";
  myGameArea.context.fillText("Score : " + myGameArea.score, 10, 30);
  myGameArea.context.fillText("Health : " + myHero.health, 10, 60);
  myHero.update();
  // myHeroInfo.update()
  for (var i = 0 in myEnnemies) {
    if (!myEnnemies[i].dead) {
      if (myEnnemies[i].y >= 600)
        myEnnemies[i].dead = true;
      if (!myEnnemies[i].dead) {
        myEnnemies[i].update();
        if (areColliding(myEnnemies[i], myHero)) {
          myEnnemies[i].health = 0;
          myHero.health -= 20;
        }
      }
    }
  }

  for (var i = 0 in myProjectiles) {
    if (!myProjectiles[i].dead) {
      if (myProjectiles[i].y <= 0)
        myProjectiles[i].dead = true;
      if (!myProjectiles[i].dead)
        myProjectiles[i].update();
    }
  }

  for (var i = 0 in myEnnemies)
    if (!myEnnemies[i].dead) {
      for (var j = 0 in myProjectiles) {
        if (!myProjectiles[j].dead) {
          if (myProjectiles[j].y - myProjectiles[j].height + 5 <= myEnnemies[i].y) {
            if (areColliding(myEnnemies[i], myProjectiles[j])) {
              myGameArea.score += 10;
              myEnnemies[i].dead = true;
              myProjectiles[j].dead = true;
            }
          }
        }
      }
    }
  } else {
    myGameArea.context.font = "50px Consolas";
    myGameArea.context.fillText("GAME OVER", 10, 110);
  }
}
function action(event) {
  if (event.keyCode == 87) {
    myHero.speed_x *= -1;
  }
  else if (event.keyCode == 88) {
    if (!myHero.cooldown) {
      var shoot = new Audio('shoot.wav');
      shoot.play();
      projectile1 = new Component("player_bullet", 1, 5, 10, "black", (myHero.x+myHero.width/2)-10, myHero.y , 0, -3);
      projectile2 = new Component("player_bullet", 1, 5, 10, "black", (myHero.x+myHero.width/2)+10, myHero.y , 0, -3);
      myProjectiles.push(projectile1);
      myProjectiles.push(projectile2);
      myHero.cooldown = 25;
    }
  }
}
