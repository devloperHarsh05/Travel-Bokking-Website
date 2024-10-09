const searchBox = document.querySelector('.search-box');
const searchBtn = document.querySelector('.search-icon-find');
const search = document.querySelector('.item-search');
const closeBtn = document.querySelector('.close-icon-close');

searchBtn.addEventListener('click', function(){
  console.log(search.classList.contains('active'));
  if(search.classList.contains('active')){
    searchBox.value = '';
  }
  else {
    search.classList.add('active');
    searchBox.focus();

  }
});

closeBtn.addEventListener('click', function(){
  search.classList.remove('active');
  searchBox.value = '';
});
