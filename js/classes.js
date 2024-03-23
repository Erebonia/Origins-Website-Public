// Called inside classes.js

function openskil(evt, skilName) {

		var i, x, tablinks;

		x = document.getElementsByClassName("skil");

		for (i = 0; i < x.length; i++) {

			x[i].style.display = "none";

		}

		tablinks = document.getElementsByClassName("tablink");

		for (i = 0; i < x.length; i++) {

			tablinks[i].className = tablinks[i].className.replace(" w3-red", "");

		}

		document.getElementById(skilName).style.display = "block";

		evt.currentTarget.className += " w3-red";

	}


function generateContent() {
  var display_name = 
  ["Swordsman", "Mercenary", "Sharpshooter", "Acrobat", "Elementalist", "Mystic", "Paladin", "Priest", "Engineer", "Alchemist"];

  /* NO SPACES IN THIS ARRAY */
  var classNames = ["swordsman,mercenary,sharpshooter,acrobat,elementalist,mystic,paladin,priest,engineer,alchemist"];
  var classes = classNames[0].split(",");

   var info = {};

   info["swordsman"] = '<p><b>Primary Weapon: Greatswords </b></p> <p>Swordsmen specialize in the use of greatswords and can create long chains of combos that do massive damage. As Swordsmen continue to rise in level, they can further specialize their abilities, choosing to focus on doing massive damage to a single opponent or less damage to many opponents at once.</p>';
   info["mercenary"] = '<p><b>Primary Weapon(s): Axes, Hammers</b></p> <p>Mercenaries do less damage and are much less mobile than Swordsmen. They make up for this however, by being the most heavily armored character in the game. Their primary focus is engaging enemies one-on-one and taking the kind of blows other characters can’t, allowing their friends the opportunity to damage and destroy larger enemies.</p>';
   info["sharpshooter"] = '<p><b>Primary Weapon(s): Longbow, Crossbow</b></p> <p>Sharpshooters specialize in the use of bows at the expense of their acrobatic skills and melee attacks. As such, they tend to be very vulnerable when up close with an opponent. At range though, there is no class in the game who can do as much damage as a well-played Sharpshooter.</p>';
   info["acrobat"] = '<p><b>Primary Weapon: Shortbow </b></p> <p>While still excellent long-range attackers, Acrobats give up some of their most damaging bow skills in favor of acquiring a devastating arsenal of lightning-fast kicks and strikes. While still poorly armored, Acrobats are one of the most agile classes, boasting plenty of escape moves that allow them to get in close, do damage and get out before the foe even knows what hit them.</p>';
   info["elementalist"] = '<p><b>Primary Weapon: Staves </b></p> <p>Elementalists are the queens of elemental magic and can create walls of ice, poison pits, flame trails and more as they take ultimate control of the battlefield. Although Elementalists have the disadvantage of lower health, they more than compensate with their ultimate damage. When in doubt, let an Elementalist “divide and conquer” the battlefield for you!</p>';
   info["mystic"] = '<p><b>Primary Weapon: Staves </b></p> <p>Mystics go far beyond merely using the elements to inflict status ailments. They harness the very force of creation itself such as gravity and black holes to rip creatures apart, crush them mercilessly, or just whip them around to give their friends the chance to slice and dice them. The Mystic can change the tide of battle in seconds.</p>';
   info["paladin"] = '<p><b>Primary Weapon(s): Flails, Maces</b></p> <p>More than any other class, the Paladin specializes in keeping himself alive. A sort of “armored turtle,” the Paladin is really good at taking a beating to distract monsters in order to give his friends time to destroy them. Their greatest weakness is their low damage and small mana pool that forces them to be very careful when casting spells.</p>';
   info["priest"] = '<p><b>Primary Weapon: Wands </b></p> <p>Unlike Paladins, Priests have larger mana pools and more attack spells at their disposal. That means they can serve as a secondary damage dealer in a party. Their most effective role though, is as a healer. A good Priest in a party keeping everybody alive is often the difference between life and death in a dungeon.</p>';
   info["engineer"] = '<p><b>Primary Weapon: Cannon </b></p> <p>Using her vast knowledge of mechanical technology, the Engineer wields weapons of mass destruction. Flanked by her trusted robot Alfredo and a small army of robot ducks, the Engineer lays waste to the battlefield, bringing nothing short of complete and utter devastation to her enemies.</p>';
   info["alchemist"] = '<p><b>Primary Weapon: Bubble Blaster </b></p> <p>Utilizes elemental magic through the use of her bubble blasters. Enemies often underestimate her due to her looks and pay a hefty price when they are frozen, poisoned, and engulfed in flames.</p>';


  var doc = document.getElementById("allClasses");
  for(i=0; i<classes.length; i++){

  	classes[i] = classes[i] == null ? "" : classes[i];
  	info[classes[i]] = info[classes[i]] == null ? "<p>Content is still in progress...</p>" : info[classes[i]];

  	if(i == 0){
  		var content = '<div id="'+classes[i]+'" class="w3-container w3-border skil"> <img class="class-showcase" src="img/class/V2/'+classes[i]+'.png" /> <h4><img style="opacity: 1 !important" src="img/class/iconsv2/'+classes[i]+'.png"> '+display_name[i]+'</h4> '+info[classes[i]]+'</div>';
	} else {
		var content = '<div id="'+classes[i]+'" class="w3-container w3-border skil" style="display:none"> <img class="class-showcase" src="img/class/V2/'+classes[i]+'.png" /> <h4><img style="opacity: 1 !important" src="img/class/iconsv2/'+classes[i]+'.png"> '+display_name[i]+'</h4> '+info[classes[i]]+'</div>';
	}

  doc.innerHTML += content;
  }
}

window.onload=generateContent();