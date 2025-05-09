document.getElementById('fusao').onclick = function() {
    const r = document.getElementById('red').checked;
    const g = document.getElementById('green').checked;
    const b = document.getElementById('blue').checked;
    let result = '';
    if (r && g && b) result = 'White';
    else if (r && g) result = 'Yellow';
    else if (r && b) result = 'Purple';
    else if (g && b) result = 'Cyan';
    else if (r) result = 'Red';
    else if (g) result = 'Green';
    else if (b) result = 'Blue';
    else result = 'Black';
    alert(result);
};