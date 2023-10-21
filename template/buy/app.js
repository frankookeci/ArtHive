let openShopping = document.querySelector('.shopping');
let closeShopping = document.querySelector('.closeShopping');
let list = document.querySelector('.list');
let listCard = document.querySelector('.listCard');
let body = document.querySelector('body');
let total = document.querySelector('.total');
let quantity = document.querySelector('.quantity');

openShopping.addEventListener('click', () => {
  body.classList.add('active');
})
closeShopping.addEventListener('click', () => {
  body.classList.remove('active');
})
let listCards = [];
let products = [
  {
    id: 1,
    name: 'Painttt',
    image: 'ArtHive-Canva.jpg',
    price: 80000,
    category: 'category1'
  },



  {
    id: 2,
    name: 'Photography',
    image: 'ArtHive-Canva (1).jpg',
    price: 15000,
    category: 'category5'
  },
  {
    id: 3,
    name: 'Pottery',
    image: 'ArtHive-Canva (2).jpg',
    price: 22000,
    category: 'category4'

  },
  {
    id: 4,
    name: 'Photography',
    image: 'ArtHive-Canva (3).jpg',
    price: 140000,
    category: 'category5'
  },
  {
    id: 8,
    name: 'Photography',
    image: 'ArtHive-Canva (4).jpg',
    price: 110000,
    category: 'category5'
  },
  {
    id: 9,
    name: 'Photography',
    image: 'ArtHive-Canva (5).jpg',
    price: 140000,
    category: 'category5'
  },
  {
    id: 10,
    name: 'Photography',
    image: 'ArtHive-Canva (6).jpg',
    price: 190000,
    category: 'category5'
  },
  {
    id: 5,
    name: 'Quilling',
    image: 'ArtHive-Canva (7).jpg',
    price: 123000,
    category: 'category3'

  }


];
let currentIndex = 0;

function initApp() {
  renderProducts();
}

function renderProducts(filteredProducts) {
  list.innerHTML = '';
  for (let i = currentIndex; i < currentIndex + 12; i++) {
    let index = i % products.length; // Calculate the actual index within the products array
    let value = filteredProducts ? filteredProducts[index] : products[index];
    let newDiv = document.createElement('div');
    newDiv.classList.add('item');
    newDiv.style.backgroundImage = `url("image/${value.image}")`;
    newDiv.innerHTML = `
      <img src="image/${value.image}" onmouseover="addBorder(this)" onmouseout="removeBorder(this)">
      <div class="title">${value.name}</div>
      <div class="price">$${value.price.toLocaleString()}</div>
      <div class="buttons">
        <button onclick="addToCard(${index})"><ion-icon name="bag-check-outline"></ion-icon></button>
        <button class="always-visible" onclick="likeadd(${index})"><ion-icon name="heart-outline"></ion-icon></button>
      </div>
    `;
    list.appendChild(newDiv);
  }
}


function moveItems(direction) {
  if (direction === 'left') {
    const lastItem = products.pop(); // Remove the last item from the products array
    products.unshift(lastItem); // Add the last item to the beginning of the products array
  } else if (direction === 'right') {
    const firstItem = products.shift(); // Remove the first item from the products array
    products.push(firstItem); // Add the first item to the end of the products array
  }

  renderProducts();
}

function addToCard(key) {
  if (listCards[key] == null) {
    // Copy product from list to list card
    listCards[key] = JSON.parse(JSON.stringify(products[key]));
    listCards[key].quantity = 1;
  }
  reloadCard();

  // Filter out null values from listCards array
  const filteredListCards = listCards.filter(item => item !== null);

  // Create a new XMLHttpRequest object
  const xhr = new XMLHttpRequest();

  // Set up the request
  xhr.open("POST", "save_items.php", true);
  xhr.setRequestHeader("Content-Type", "application/json");

  // Set up the callback function to handle the response
  xhr.onreadystatechange = function () {
    if (xhr.readyState === 4 && xhr.status === 200) {
      // Request completed successfully
      console.log("Items saved successfully!");
      console.log(xhr.responseText); // Display the response in the console
    }
  };

  // Convert the listCards array to JSON
  const jsonData = JSON.stringify(filteredListCards);

  // Send the JSON data in the request body
  xhr.send(jsonData);
}



function openPage() {
  // Redirect the user to the new page
  window.location.href = "checkout.html";
}




function addBorder(element) {
  element.style.border = '2px solid transparent';
}

function removeBorder(element) {
  element.style.border = 'none';
}

// ...


// ...

initApp();





function reloadCard() {
  listCard.innerHTML = '';
  let count = 0;
  let totalPrice = 0;

  listCards.forEach((value, key) => {
    totalPrice = totalPrice + value.price;
    count = count + value.quantity;
    if (value != null) {
      let newDiv = document.createElement('li');
      newDiv.innerHTML = `
                <div><img src="image/${value.image}"/></div>
                <div>${value.name}</div>
                <div>${value.price.toLocaleString()}</div>
                <div>
                    <button onclick="changeQuantity(${key}, ${value.quantity - 1})">-</button>
                    <div class="count">${value.quantity}</div>
                    <button onclick="changeQuantity(${key}, ${value.quantity + 1})">+</button>
                   
                </div>`;
      listCard.appendChild(newDiv);
    }
  })
  total.innerText = 'Total: $' + totalPrice.toLocaleString();
  quantity.innerText = count;
}
function changeQuantity(key, quantity) {
  if (quantity == 0) {
    delete listCards[key];
  } else {
    listCards[key].quantity = quantity;
    listCards[key].price = quantity * products[key].price;
  }
  reloadCard();
}
// -----------------------------------------------------



function filterImages(category) {
  let filteredProducts;
  if (category === 'all') {
    filteredProducts = products; // Show all products
  } else {
    filteredProducts = products.filter(product => product.category === category); // Filter products based on the category
  }
  renderProducts(filteredProducts); // Render the filtered products
}







//   --------------------
//   LIKESS

let likesImage = document.querySelector('.likes img');
let list2 = document.querySelector('.list2');
let card2 = document.querySelector('.card2');
let closeLikes = document.querySelector('.closelikes');
let total2 = document.querySelector('.total2');
let quantity2 = document.querySelector('.quantity2');
let openlist = document.querySelector('.likes');
let listcard2 = document.querySelector('.listCard2');

// openlist.addEventListener('click', ()=>{
//     body.classList.add('active2');
// })


openlist.addEventListener('click', () => {
  body.classList.add('active2');
  card2.style.display = 'block';
  setTimeout(() => {
    card2.classList.add('active2');
  }, 0);
});
closeLikes.addEventListener('click', () => {
  card2.classList.remove('active2');
  body.classList.remove('active2');
  setTimeout(() => {
    card2.style.display = 'none';
  }, 500);
});

let listcards2 = [];
function likeadd(key) {
  if (listcards2[key] == null) {
    listcards2[key] = JSON.parse(JSON.stringify(products[key]));

    listcards2[key].quantity2 = 1;

  }
  reloadCard2();
}

function reloadCard2() {
  listcard2.innerHTML = '';
  let count2 = 0;
  let totalPrice2 = 0;
  listcards2.forEach((value, key) => {
    totalPrice2 = totalPrice2 + value.price;
    count2 = count2 + value.quantity2;
    if (value != null) {
      let newDiv1 = document.createElement('li');
      newDiv1.innerHTML = `
        <div><img src="image/${value.image}"/></div>
        <div>${value.name}</div>
        <div>${value.price.toLocaleString()}</div>
        <div>
            <button onclick="changeQuantity2(${key}, ${value.quantity2 - 1})">-</button>
            <div class="count2">${value.quantity2}</div>
            <button onclick="changeQuantity2(${key}, ${value.quantity2 + 1})">+</button>
           
        </div>`;
      listcard2.appendChild(newDiv1);
    }
  })
  total2.innerHTML = 'Total: $' + totalPrice2.toLocaleString();
  quantity2.innerHTML = count2;
}


function changeQuantity2(key, quantity2) {
  if (quantity2 == 0) {
    delete listcards2[key];
  } else {
    listcards2[key].quantity2 = quantity2;
    listcards2[key].price = quantity2 * products[key].price;
  }
  reloadCard2();
}


// Assuming you have multiple items with different images
const items = document.querySelectorAll('.list .item');

items.forEach(item => {
  const imgSrc = item.querySelector('img').src;
  item.style.backgroundImage = `url("${imgSrc}")`;
});
