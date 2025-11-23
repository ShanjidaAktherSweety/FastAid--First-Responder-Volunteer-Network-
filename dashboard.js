const statusText = document.getElementById('status-text');
  const activeBtn = document.querySelector('.active-btn');
  const offlineBtn = document.querySelector('.offline-btn');

  activeBtn.addEventListener('click', () => {
    statusText.textContent = 'Available';
    statusText.classList.remove('offline');
    statusText.classList.add('available');
  });

  offlineBtn.addEventListener('click', () => {
    statusText.textContent = 'Offline';
    statusText.classList.remove('available');
    statusText.classList.add('offline');
  });



  //get dom access
  let activeCases = document.querySelector('.active-res');
  let pastCases = document.querySelector('.past-res');
  let activeCaseCSS = document.querySelector('.active-case-detail');
  let caseCSS = document.querySelector('.case');
  let pastCaseDetailCSS = document.querySelector('.past-case-detail');
  let pastCaseCSS = document.querySelector('.past-case');

  //Active and past case
  pastCaseDetailCSS.style.display = 'none';
  pastCaseCSS.style.display = 'none';
  activeCases.style.color="blue"

  activeCases.addEventListener('click', () => {
    pastCaseDetailCSS.style.display = 'none';
    pastCaseCSS.style.display = 'none';
    activeCaseCSS.style.display = 'block';
    caseCSS.style.display = 'block';
    activeCases.style.color="blue"
    pastCases.style.color="black"
  });

  pastCases.addEventListener('click', () => {
    activeCaseCSS.style.display = 'none';
    caseCSS.style.display = 'none';
    pastCaseDetailCSS.style.display = 'block';
    pastCaseCSS.style.display = 'block';
    pastCases.style.color="blue"
    activeCases.style.color="black"

  });