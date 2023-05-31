function hamburgerMenu(){
	var x =document.getElementById("Top");
	if (x.className ==="nav"){
		x.className += " responsive";
	}else{
		x.className = "nav";
	}
}
//Every thing below this line is where I simulataded DB data with JS, and can be removed once the DB data is working with the grid/grid items
class courseTab {
  constructor(type, image, tagline, heading, description, link) {
    this.type = type;
    this.image = image;
    this.tagline= tagline;
    this.heading= heading;
    this.description= description;
    this.link= link;
  }
}
const courses = [
  new courseTab("databases", "databaseplaceholder.jpg","Databases", "Database Development","Lorem ipsum dolor sit amet,consectetur adipiscing elit.","#"),
  new courseTab("design", "designplaceholder.jpg","Design", "Web Design","Lorem ipsum dolor sit amet,consectetur adipiscing elit.","#"),
  new courseTab("ecommerce", "ecommerceplaceholder.jpg","E-Commerce", "E-Commerce strategies","Lorem ipsum dolor sit amet,consectetur adipiscing elit.","#"),
  new courseTab("data", "dataplaceholder.jpg","Data Structures", "Data Structures: The Basics","Lorem ipsum dolor sit amet,consectetur adipiscing elit.","#"),
  new courseTab("marketing", "marketingplaceholder.jpg","Marketing", "The importance of social media marketing","Lorem ipsum dolor sit amet,consectetur adipiscing elit.","#"),
  new courseTab("webdev", "webdevplaceholder.jpg","Web Development", "Beginners HTML and CSS","Lorem ipsum dolor sit amet,consectetur adipiscing elit.","#"),
  new courseTab("databases", "databaseplaceholder.jpg","Databases", "Using Forms and Reports","Lorem ipsum dolor sit amet,consectetur adipiscing elit.","#"),
  new courseTab("webdev", "webdevplaceholder.jpg","Web Development", "Beginners JavaScript","Lorem ipsum dolor sit amet,consectetur adipiscing elit.","#"),
  new courseTab("webdev", "webdevplaceholder.jpg","Web Development", "Beginners HTML and CSS","Lorem ipsum dolor sit amet,consectetur adipiscing elit.","#"),
  new courseTab("databases", "databaseplaceholder.jpg","Databases", "Using Forms and Reports","Lorem ipsum dolor sit amet,consectetur adipiscing elit.","#"),
  new courseTab("webdev", "webdevplaceholder.jpg","Web Development", "Beginners JavaScript","Lorem ipsum dolor sit amet,consectetur adipiscing elit.","#"),
]
var i = 0;
var n = 8;
function displayCourses(more,type){
  switch (type){
    case "featured":
      document.getElementById("gridTitle").innerHTML="Featured Courses";
      document.getElementById("gridDescription").innerHTML= "Here are our featured courses:";
      break;
    case "databases":
      document.getElementById("gridTitle").innerHTML="Database Courses";
      document.getElementById("gridDescription").innerHTML= "Here are our database courses:";
      break;
    case "design":
      document.getElementById("gridTitle").innerHTML="Design Courses";
      document.getElementById("gridDescription").innerHTML= "Here are our design courses:";
    break;
      case "ecommerce":
      document.getElementById("gridTitle").innerHTML="E-commerce Courses";
      document.getElementById("gridDescription").innerHTML= "Here are our e-commerce courses:";
      break;
    case "data":
      document.getElementById("gridTitle").innerHTML="Data Struture Courses";
      document.getElementById("gridDescription").innerHTML= "Here are our data structure courses:";
      break;
    case "marketing":
      document.getElementById("gridTitle").innerHTML="Marketing Courses";
      document.getElementById("gridDescription").innerHTML= "Here are our marketing courses:";
      break;
    case "webdev":
      document.getElementById("gridTitle").innerHTML="Web Development Courses";
      document.getElementById("gridDescription").innerHTML= "Here are our web development courses:";
  }
  if (more != 'more'){
    document.getElementById("grid").innerHTML="";
    i=0;
    n=8;
  }
  else{
    n=courses.length;
  }
  while(i < n){
    let grid = document.getElementById("grid");
    let gridItem = document.createElement("div");
    gridItem.className="gridItem";
    gridItem.id=courses[i].type;
    if (gridItem.id == type && type != 'featured'){
      gridItem.innerHTML = '<img src="../Images/'+ courses[i].image +'" alt="course image"><h4>'+ courses[i].tagline +'</h4><h3>'+ courses[i].heading +'</h3><p>'+ courses[i].description +'</p><a src="'+ courses[i].link +'">More Info</a>';
       grid.appendChild(gridItem);
      i++;
    }
    else if(type == 'featured'){
      gridItem.innerHTML = '<img src="../Images/'+ courses[i].image +'" alt="course image"><h4>'+ courses[i].tagline +'</h4><h3>'+ courses[i].heading +'</h3><p>'+ courses[i].description +'</p><a src="'+ courses[i].link +'">More Info</a>';
      grid.appendChild(gridItem);
      i++;
    }
    else{
      i++;
      n++;
    }
  }
  document.getElementById("moreButton").setAttribute('onclick', 'displayCourses("more","'+ type +'")');
}
window.onload = function (event) {
  displayCourses('default','featured');
}