window.addEventListener('DOMContentLoaded', () => {
    const container = document.querySelector('div');
    const before = container.querySelector('img[src="before.jpg"]');
    const splitter = container.querySelector('img[src="splitter.svg"]');



    let dragging = false;
    function onMove(e) {
        if (!dragging) return;
        const rect = container.getBoundingClientRect();
        const x = e.clientX - rect.left;
        const position = Math.min(Math.max(x, 0), rect.width);
        let percent = (position / rect.width) * 100;

        splitter.style.left = `${percent}%`;
        before.style.clipPath = `inset(0 ${100 - percent}% 0 0)`;
    }
    
    function onMouseDown(e) {
        e.preventDefault()
        dragging = true;
        onMove(e);
    }

    function onMouseUp() {
        dragging = false;
    }



    container.addEventListener('mousemove', onMove);
    container.addEventListener('mousedown', onMouseDown);
    container.addEventListener('mouseup', onMouseUp);
    container.addEventListener('mouseleave', () => {
        dragging = false;
    });

    
    
});