const moons = ['🌒🏨ホ', '🌓🏨ホテ', '🌔🏨ホテル', '🌕🏨ホテルけ', '🌖🏨ホテルけん', '🌗🏨ホテルけんさ', '🌑🏨ホテルけんさく'];
let count = 0;
setInterval(()=> {
	location.hash = moons[count % moons.length];
	count++;
}, 200);