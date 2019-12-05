var t1=new TimelineMax({onUpdate:updatePercentage});
const controller= new ScrollMagic.Controller;
tl.from('blockquote', .5, {x:-200, opacity: 0});
const scene = new ScrollMagic.Scene({
    triggerElement: ".page",
    triggerHook:"onLeave",
    duration:"100%"
})
    .setPin(".page")
    .setTween(t1)
    .addTo(controller);

function updatePercentage() {
    //percent.innerHTML = (tl.progress() *100 ).toFixed();
    tl.progress();
    console.log(tl.progress());
}