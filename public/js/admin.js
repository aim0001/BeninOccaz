// Initialisation commune à toutes les pages
document.addEventListener('DOMContentLoaded', function() {
    // Animation des cartes
    const cards = document.querySelectorAll('.card');
    cards.forEach((card, index) => {
        setTimeout(() => {
            card.style.opacity = '1';
            card.style.transform = 'translateY(0)';
        }, index * 100);
    });
    
    // Effet hover sur les lignes du tableau
    const tableRows = document.querySelectorAll('tbody tr');
    tableRows.forEach(row => {
        row.addEventListener('mouseenter', () => {
            row.style.backgroundColor = '#f8f9fa';
        });
        row.addEventListener('mouseleave', () => {
            row.style.backgroundColor = '';
        });
    });
    
    // Gestion des onglets (pour la page paramètres)
    const tabs = document.querySelectorAll('.tab');
    if(tabs.length > 0) {
        tabs.forEach(tab => {
            tab.addEventListener('click', function() {
                // Désactiver tous les onglets et contenus
                document.querySelectorAll('.tab').forEach(t => t.classList.remove('active'));
                document.querySelectorAll('.settings-content').forEach(c => c.classList.remove('active'));
                
                // Activer l'onglet cliqué
                this.classList.add('active');
                
                // Afficher le contenu correspondant
                const tabId = this.getAttribute('data-tab');
                document.getElementById(tabId + '-settings').classList.add('active');
            });
        });
    }
    
    // Afficher/masquer le mot de passe
    const togglePassword = document.querySelector('.fa-eye')?.parentElement;
    if (togglePassword) {
        togglePassword.addEventListener('click', function() {
            const passwordField = document.getElementById('feda-secret');
            if (passwordField.type === 'password') {
                passwordField.type = 'text';
                this.innerHTML = '<i class="fas fa-eye-slash"></i> Masquer';
            } else {
                passwordField.type = 'password';
                this.innerHTML = '<i class="fas fa-eye"></i> Afficher';
            }
        });
    }
    
    // Copier les clés API
    document.querySelectorAll('.fa-copy').forEach(icon => {
        icon.parentElement.addEventListener('click', function() {
            const apiKey = this.previousElementSibling.textContent;
            navigator.clipboard.writeText(apiKey);
            
            // Feedback visuel
            const originalText = this.innerHTML;
            this.innerHTML = '<i class="fas fa-check"></i> Copié';
            setTimeout(() => {
                this.innerHTML = originalText;
            }, 2000);
        });
    });
    
    // Initialisation des graphiques (pour la page statistiques)
    if(document.getElementById('revenueChart')) {
        initCharts();
    }
});

// Fonction pour initialiser les graphiques
function initCharts() {
    // Revenue Chart
    const revenueCtx = document.getElementById('revenueChart').getContext('2d');
    new Chart(revenueCtx, {
        type: 'line',
        data: {
            labels: ['Jan', 'Fév', 'Mar', 'Avr', 'Mai', 'Juin', 'Juil', 'Août', 'Sep', 'Oct', 'Nov', 'Déc'],
            datasets: [{
                label: 'Chiffre d\'Affaires (FCFA)',
                data: [450000, 520000, 480000, 620000, 750000, 820000, 780000, 850000, 920000, 880000, 950000, 1100000],
                borderColor: '#6C63FF',
                backgroundColor: 'rgba(108, 99, 255, 0.1)',
                borderWidth: 2,
                fill: true,
                tension: 0.4
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: {
                    position: 'top',
                },
                tooltip: {
                    callbacks: {
                        label: function(context) {
                            return context.dataset.label + ': ' + context.parsed.y.toLocaleString('fr-FR') + ' FCFA';
                        }
                    }
                }
            }
        }
    });
    
    // Status Chart
    const statusCtx = document.getElementById('statusChart').getContext('2d');
    new Chart(statusCtx, {
        type: 'doughnut',
        data: {
            labels: ['Complétées', 'En attente', 'Échouées', 'Remboursées'],
            datasets: [{
                data: [1248, 56, 24, 18],
                backgroundColor: [
                    '#28A745',
                    '#FFC107',
                    '#DC3545',
                    '#17A2B8'
                ],
                borderWidth: 0
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: {
                    position: 'right',
                }
            }
        }
    });
    
    // Users Chart
    const usersCtx = document.getElementById('usersChart').getContext('2d');
    new Chart(usersCtx, {
        type: 'bar',
        data: {
            labels: ['Jan', 'Fév', 'Mar', 'Avr', 'Mai', 'Juin', 'Juil', 'Août', 'Sep', 'Oct', 'Nov', 'Déc'],
            datasets: [{
                label: 'Nouveaux Utilisateurs',
                data: [45, 58, 62, 78, 85, 92, 88, 76, 105, 120, 132, 148],
                backgroundColor: '#4D44DB',
                borderWidth: 0
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: {
                    position: 'top',
                }
            },
            scales: {
                y: {
                    beginAtZero: true,
                    ticks: {
                        stepSize: 20
                    }
                }
            }
        }
    });
}

// Fonction pour ouvrir les modals (page litiges)
function openModal(modalId) {
    document.getElementById(modalId).style.display = 'flex';
}

function closeModal(modalId) {
    document.getElementById(modalId).style.display = 'none';
}

// Fermer le modal en cliquant à l'extérieur
window.onclick = function(event) {
    const modals = document.querySelectorAll('.modal');
    modals.forEach(modal => {
        if (event.target === modal) {
            modal.style.display = 'none';
        }
    });
}