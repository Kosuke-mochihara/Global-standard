const tabMenu = document.querySelectorAll('.c-tab__menuItem');
const tabContent = document.querySelectorAll('.c-tab__contentItem');

tabMenu.forEach((tab, index) => {
    tab.addEventListener('click', function() {
        // クリックされたタブ以外の.js-tab-activeを外し、対応するタブコンテンツを非表示に
        tabMenu.forEach((otherTab, otherIndex) => {
            if (otherIndex !== index) {
                otherTab.classList.remove('js-tab-active');
                tabContent[otherIndex].style.display = 'none';
            }
        });

        // 現在のタブボタンとタブコンテンツをアクティブに設定
        tab.classList.add('js-tab-active');
        tabContent[index].style.display = 'block';

        // :scope その要素自身 表示させたいタブコンテンツの<img>と<p>タグを取得
        let img = tabContent[index].querySelector(':scope > img');
        let p = tabContent[index].querySelector(':scope > p');
        let tl = gsap.timeline({scrollTrigger:{
            trigger:tabContent[index],// これから表示させたいタブコンテンツをトリガーに
            start:'top center',// 発火位置 トリガーの上端(top)が画面中央(center)
        }});
        // アニメーションの内容
        tl
        .fromTo(img,{clipPath:'inset(0 100% 0 0)'},{clipPath:'inset(0 0% 0 0)',duration:0.3})
        .fromTo(p,{clipPath:'inset(0 100% 0 0)'},{clipPath:'inset(0 0% 0 0)',duration:0.3},'>')
    });
});