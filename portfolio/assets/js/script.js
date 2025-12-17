document.querySelectorAll('nav a').forEach(a=>{
    a.onclick=e=>{
        e.preventDefault();
        document.querySelector(a.getAttribute('href')).scrollIntoView({behavior:"smooth"});
    }
});
