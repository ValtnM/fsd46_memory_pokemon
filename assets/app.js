import './bootstrap.js';
/*
 * Welcome to your app's main JavaScript file!
 *
 * This file will be included onto the page via the importmap() Twig function,
 * which should already be in your base.html.twig.
 */
import './styles/app.scss';

console.log('This log comes from assets/app.js - welcome to AssetMapper! 🎉');

const cards = document.querySelectorAll('.content');
const nbCards = cards.length;
let selectedCard = "";
cards.forEach(card => {    
    card.addEventListener('click', () => {
        let visibleCards = document.querySelectorAll('.visible');
        // Si il y a déjà 2 cartes visible on ignore le click
        if(visibleCards.length < 2) {
            const cardClassName = card.className;

            // Si la carte est déjà visible on ignore le click
            if(!cardClassName.includes('visible') && !cardClassName.includes('found')) {

                // On rend visible la carte cliquée
                card.classList.add('visible'); 
                
                // On récupère le nom du pokémon
                let cardName = card.querySelector('h2').textContent;
                

                // Si une autre carte a déjà été sélectionnée...
                if(selectedCard != "") {
                    // Si les deux cartes correspondent
                    if(cardName != selectedCard) {
                        setTimeout(() => {
                            console.log('pause');
                            let visibleCards = document.querySelectorAll('.visible');
                            visibleCards.forEach(visibleCard => {
                                visibleCard.classList.remove('visible');
                            });
                        }, 2000)
                    } else {
                        let visibleCards = document.querySelectorAll('.visible');
                        visibleCards.forEach(visibleCard => {
                            visibleCard.classList.add('found');
                            visibleCard.classList.remove('visible');
                        });                
                        let foundCards = document.querySelectorAll('.found');
                        if(foundCards.length == nbCards) {
                            alert('Bravo ! Vous avez gagné !');
                        }
                    }  
                    selectedCard = "";
                    
                } else {                 
                    selectedCard = cardName;
                    console.log("hi");
                }
            }
        }
        
        
    });
});
