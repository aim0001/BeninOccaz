@extends('admin.template')

@section('title', 'Parametres')

@section('content')
<style>
    /* Settings Tabs */
    .settings-tabs {
        display: flex;
        border-bottom: 1px solid #e0e0e0;
        margin-bottom: 20px;
    }

    .tab {
        padding: 10px 20px;
        cursor: pointer;
        border-bottom: 3px solid transparent;
        transition: all 0.3s;
        font-weight: 500;
    }

    .tab.active {
        border-bottom-color: var(--primary);
        color: var(--primary);
    }

    .tab:hover:not(.active) {
        background-color: #f8f9fa;
    }

    /* Settings Content */
    .settings-content {
        display: none;
    }

    .settings-content.active {
        display: block;
    }

    /* Settings Card */
    .settings-card {
        background: white;
        border-radius: 10px;
        padding: 20px;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.05);
        margin-bottom: 30px;
    }

    .settings-card-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 20px;
        padding-bottom: 10px;
        border-bottom: 1px solid #f0f0f0;
    }

    .settings-card-title {
        font-size: 18px;
        font-weight: 600;
    }

    /* Form Elements */
    .form-group {
        margin-bottom: 20px;
    }

    .form-group label {
        display: block;
        margin-bottom: 8px;
        font-weight: 500;
        font-size: 14px;
    }

    .form-control {
        width: 100%;
        padding: 10px 15px;
        border: 1px solid #e0e0e0;
        border-radius: 5px;
        font-size: 14px;
        transition: all 0.3s;
    }

    .form-control:focus {
        border-color: var(--primary);
        outline: none;
        box-shadow: 0 0 0 3px rgba(108, 99, 255, 0.1);
    }

    .form-text {
        font-size: 12px;
        color: var(--gray);
        margin-top: 5px;
    }

    .form-row {
        display: flex;
        gap: 20px;
    }

    .form-row .form-group {
        flex: 1;
    }

    /* Switch */
    .switch {
        position: relative;
        display: inline-block;
        width: 50px;
        height: 24px;
    }

    .switch input {
        opacity: 0;
        width: 0;
        height: 0;
    }

    .slider {
        position: absolute;
        cursor: pointer;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background-color: #e0e0e0;
        transition: .4s;
        border-radius: 24px;
    }

    .slider:before {
        position: absolute;
        content: "";
        height: 16px;
        width: 16px;
        left: 4px;
        bottom: 4px;
        background-color: white;
        transition: .4s;
        border-radius: 50%;
    }

    input:checked+.slider {
        background-color: var(--primary);
    }

    input:checked+.slider:before {
        transform: translateX(26px);
    }

    .switch-container {
        display: flex;
        align-items: center;
        gap: 10px;
    }

    /* Buttons */
    .btn {
        padding: 10px 20px;
        border-radius: 5px;
        border: none;
        background-color: var(--primary);
        color: white;
        cursor: pointer;
        font-size: 14px;
        transition: all 0.3s;
        display: inline-flex;
        align-items: center;
    }

    .btn i {
        margin-right: 8px;
    }

    .btn:hover {
        background-color: var(--secondary);
    }

    .btn-secondary {
        background-color: white;
        border: 1px solid #e0e0e0;
        color: var(--gray);
    }

    .btn-secondary:hover {
        background-color: #f8f9fa;
        color: var(--dark);
    }

    .btn-danger {
        background-color: var(--danger);
    }

    .btn-danger:hover {
        background-color: #c82333;
    }

    /* API Keys */
    .api-key-container {
        display: flex;
        gap: 10px;
        margin-top: 10px;
    }

    .api-key-value {
        flex: 1;
        padding: 10px;
        background-color: #f8f9fa;
        border-radius: 5px;
        font-family: monospace;
        font-size: 14px;
        border: 1px dashed #e0e0e0;
        overflow: hidden;
        text-overflow: ellipsis;
    }

    /* Responsive */
    @media (max-width: 768px) {
        .settings-tabs {
            overflow-x: auto;
            white-space: nowrap;
            padding-bottom: 5px;
        }

        .form-row {
            flex-direction: column;
            gap: 0;
        }
    }
</style>
<!-- Settings Tabs -->
<div class="settings-tabs">
    <div class="tab active" data-tab="general">Général</div>
    <div class="tab" data-tab="payment">Paiement</div>
    <div class="tab" data-tab="delivery">Livraison</div>
    <div class="tab" data-tab="notifications">Notifications</div>
    <div class="tab" data-tab="api">API</div>
    <div class="tab" data-tab="security">Sécurité</div>
</div>

<!-- General Settings -->
<div class="settings-content active" id="general-settings">
    <div class="settings-card">
        <div class="settings-card-header">
            <div class="settings-card-title">Informations de la Plateforme</div>
        </div>

        <div class="form-group">
            <label for="site-name">Nom de la plateforme</label>
            <input type="text" class="form-control" id="site-name" value="MaAmir">
        </div>

        <div class="form-group">
            <label for="site-description">Description</label>
            <textarea class="form-control" id="site-description" rows="3">Marketplace de seconde main au Bénin - Vendez et achetez en toute sécurité</textarea>
        </div>

        <div class="form-group">
            <label for="site-logo">Logo</label>
            <input type="file" class="form-control" id="site-logo">
            <div class="form-text">Format recommandé : PNG 200x200px</div>
        </div>

        <div class="form-group">
            <label for="site-currency">Devise</label>
            <select class="form-control" id="site-currency">
                <option selected>Franc CFA (FCFA)</option>
                <option>Euro (€)</option>
                <option>Dollar US ($)</option>
            </select>
        </div>

        <div class="form-group">
            <label for="site-language">Langue</label>
            <select class="form-control" id="site-language">
                <option selected>Français</option>
                <option>English</option>
            </select>
        </div>

        <button class="btn">
            <i class="fas fa-save"></i> Enregistrer les modifications
        </button>
    </div>

    <div class="settings-card">
        <div class="settings-card-header">
            <div class="settings-card-title">Configuration des Commissions</div>
        </div>

        <div class="form-group">
            <label for="commission-rate">Taux de commission</label>
            <div class="form-row">
                <div class="form-group" style="flex: 0 0 150px;">
                    <input type="number" class="form-control" id="commission-rate" value="5" min="0" max="20" step="0.1">
                </div>
                <div style="align-self: center;">% par transaction</div>
            </div>
            <div class="form-text">Ce pourcentage sera prélevé sur chaque vente réussie</div>
        </div>

        <div class="form-group">
            <div class="switch-container">
                <label class="switch">
                    <input type="checkbox" checked>
                    <span class="slider"></span>
                </label>
                <span>Commission minimum active</span>
            </div>
            <div class="form-text">Applique un montant minimum de commission si le pourcentage est trop faible</div>
        </div>

        <div class="form-group">
            <label for="min-commission">Commission minimum</label>
            <div class="form-row">
                <div class="form-group" style="flex: 0 0 150px;">
                    <input type="number" class="form-control" id="min-commission" value="100" min="0" step="50">
                </div>
                <div style="align-self: center;">FCFA</div>
            </div>
        </div>

        <button class="btn">
            <i class="fas fa-save"></i> Enregistrer les commissions
        </button>
    </div>
</div>

<!-- Payment Settings -->
<div class="settings-content" id="payment-settings">
    <div class="settings-card">
        <div class="settings-card-header">
            <div class="settings-card-title">Configuration FedaPay</div>
        </div>

        <div class="form-group">
            <label for="feda-enable">Activer FedaPay</label>
            <div class="switch-container">
                <label class="switch">
                    <input type="checkbox" id="feda-enable" checked>
                    <span class="slider"></span>
                </label>
                <span>FedaPay est actuellement activé</span>
            </div>
            <div class="form-text">Désactivez pour stopper tous les paiements via FedaPay</div>
        </div>

        <div class="form-group">
            <label for="feda-mode">Mode FedaPay</label>
            <select class="form-control" id="feda-mode">
                <option value="live">Production (Live)</option>
                <option value="test">Sandbox (Test)</option>
            </select>
        </div>

        <div class="form-group">
            <label for="feda-public">Clé Publique FedaPay</label>
            <input type="text" class="form-control" id="feda-public" value="pk_live_xxxxxxxxxxxxxxxx">
        </div>

        <div class="form-group">
            <label for="feda-secret">Clé Secrète FedaPay</label>
            <input type="password" class="form-control" id="feda-secret" value="sk_live_xxxxxxxxxxxxxxxx">
            <button class="btn-secondary" style="margin-top: 10px; padding: 5px 10px;">
                <i class="fas fa-eye"></i> Afficher
            </button>
        </div>

        <div class="form-group">
            <label>Statut de la connexion</label>
            <div style="color: var(--success); font-weight: 500;">
                <i class="fas fa-check-circle"></i> Connecté à FedaPay avec succès
            </div>
            <div class="form-text">Dernière vérification: aujourd'hui à 10:15</div>
        </div>

        <button class="btn">
            <i class="fas fa-save"></i> Enregistrer les paramètres FedaPay
        </button>
    </div>

    <div class="settings-card">
        <div class="settings-card-header">
            <div class="settings-card-title">Autres Méthodes de Paiement</div>
        </div>

        <div class="form-group">
            <div class="switch-container">
                <label class="switch">
                    <input type="checkbox">
                    <span class="slider"></span>
                </label>
                <span>Paiement en espèce à la livraison</span>
            </div>
            <div class="form-text">Permet aux acheteurs de payer en cash lors de la livraison en présentiel</div>
        </div>

        <div class="form-group">
            <div class="switch-container">
                <label class="switch">
                    <input type="checkbox">
                    <span class="slider"></span>
                </label>
                <span>Mobile Money (option future)</span>
            </div>
            <div class="form-text">Activera les paiements via MTN Mobile Money et Moov Flooz</div>
        </div>
    </div>
</div>

<!-- Delivery Settings -->
<div class="settings-content" id="delivery-settings">
    <div class="settings-card">
        <div class="settings-card-header">
            <div class="settings-card-title">Options de Livraison</div>
        </div>

        <div class="form-group">
            <div class="switch-container">
                <label class="switch">
                    <input type="checkbox" checked>
                    <span class="slider"></span>
                </label>
                <span>Livraison en présentiel</span>
            </div>
            <div class="form-text">Option principale - vendeur et acheteur se rencontrent</div>
        </div>

        <div class="form-group">
            <div class="switch-container">
                <label class="switch">
                    <input type="checkbox">
                    <span class="slider"></span>
                </label>
                <span>Livraison via transporteur (option future)</span>
            </div>
            <div class="form-text">Activera la sélection de transporteurs partenaires</div>
        </div>

        <div class="form-group">
            <label>Validation de livraison</label>
            <div class="switch-container">
                <label class="switch">
                    <input type="checkbox" checked>
                    <span class="slider"></span>
                </label>
                <span>Confirmation obligatoire par l'acheteur</span>
            </div>
            <div class="form-text">Le paiement n'est libéré qu'après confirmation</div>
        </div>

        <div class="form-group">
            <div class="switch-container">
                <label class="switch">
                    <input type="checkbox" checked>
                    <span class="slider"></span>
                </label>
                <span>Code OTP/SMS en cas de hors-ligne</span>
            </div>
            <div class="form-text">Génère un code à usage unique si pas de connexion Internet</div>
        </div>

        <button class="btn">
            <i class="fas fa-save"></i> Enregistrer les paramètres
        </button>
    </div>
</div>

<!-- API Settings -->
<div class="settings-content" id="api-settings">
    <div class="settings-card">
        <div class="settings-card-header">
            <div class="settings-card-title">Clés API</div>
        </div>

        <div class="form-group">
            <label>Clé API principale</label>
            <div class="api-key-container">
                <div class="api-key-value">sk_live_xxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx</div>
                <button class="btn-secondary">
                    <i class="fas fa-copy"></i> Copier
                </button>
                <button class="btn-secondary">
                    <i class="fas fa-redo"></i> Régénérer
                </button>
            </div>
            <div class="form-text">Cette clé donne accès à toutes les fonctionnalités de l'API</div>
        </div>

        <div class="form-group">
            <label>Clé API FedaPay</label>
            <div class="api-key-container">
                <div class="api-key-value">fdpk_live_xxxxxxxxxxxxxxxxxxxxxxxx</div>
                <button class="btn-secondary">
                    <i class="fas fa-copy"></i> Copier
                </button>
            </div>
            <div class="form-text">Utilisée pour les transactions FedaPay</div>
        </div>

        <div class="form-group">
            <label>Clé API SMS Orange</label>
            <div class="api-key-container">
                <div class="api-key-value">sns_xxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx</div>
                <button class="btn-secondary">
                    <i class="fas fa-copy"></i> Copier
                </button>
            </div>
            <div class="form-text">Utilisée pour l'envoi de SMS (OTP, notifications)</div>
        </div>

        <div class="form-group">
            <label>Documentation API</label>
            <a href="#" class="btn-secondary">
                <i class="fas fa-book"></i> Voir la documentation
            </a>
        </div>
    </div>
</div>

<!-- Security Settings -->
<div class="settings-content" id="security-settings">
    <div class="settings-card">
        <div class="settings-card-header">
            <div class="settings-card-title">Sécurité du Compte</div>
        </div>

        <div class="form-group">
            <label for="current-password">Mot de passe actuel</label>
            <input type="password" class="form-control" id="current-password">
        </div>

        <div class="form-group">
            <label for="new-password">Nouveau mot de passe</label>
            <input type="password" class="form-control" id="new-password">
        </div>

        <div class="form-group">
            <label for="confirm-password">Confirmer le nouveau mot de passe</label>
            <input type="password" class="form-control" id="confirm-password">
        </div>

        <button class="btn">
            <i class="fas fa-key"></i> Changer le mot de passe
        </button>
    </div>

    <div class="settings-card">
        <div class="settings-card-header">
            <div class="settings-card-title">Sécurité Avancée</div>
        </div>

        <div class="form-group">
            <div class="switch-container">
                <label class="switch">
                    <input type="checkbox" checked>
                    <span class="slider"></span>
                </label>
                <span>Authentification à deux facteurs (2FA)</span>
            </div>
            <div class="form-text">Requis pour les actions sensibles</div>
        </div>

        <div class="form-group">
            <label>Appareils connectés</label>
            <div style="padding: 10px; background-color: #f8f9fa; border-radius: 5px;">
                <div style="display: flex; justify-content: space-between; margin-bottom: 10px;">
                    <div>
                        <strong>Chrome sur Windows</strong><br>
                        <small>192.168.1.1 - 12/06/2023 10:15</small>
                    </div>
                    <button class="btn-secondary" style="padding: 3px 8px; font-size: 12px;">
                        <i class="fas fa-times"></i> Déconnecter
                    </button>
                </div>
                <div style="display: flex; justify-content: space-between;">
                    <div>
                        <strong>Safari sur iPhone</strong><br>
                        <small>192.168.1.2 - 11/06/2023 15:30</small>
                    </div>
                    <button class="btn-secondary" style="padding: 3px 8px; font-size: 12px;">
                        <i class="fas fa-times"></i> Déconnecter
                    </button>
                </div>
            </div>
        </div>

        <div class="form-group">
            <label>Journal d'activité</label>
            <button class="btn-secondary">
                <i class="fas fa-history"></i> Voir le journal complet
            </button>
        </div>
    </div>

    <div class="settings-card">
        <div class="settings-card-header">
            <div class="settings-card-title">Zone Dangereuse</div>
        </div>

        <div class="form-group">
            <label>Supprimer toutes les données</label>
            <p style="margin-bottom: 10px;">Cette action est irréversible et supprimera toutes les données de la plateforme.</p>
            <button class="btn-danger">
                <i class="fas fa-trash"></i> Supprimer toutes les données
            </button>
        </div>

        <div class="form-group">
            <label>Exporter les données</label>
            <p style="margin-bottom: 10px;">Exportez toutes les données au format JSON ou CSV.</p>
            <button class="btn-secondary">
                <i class="fas fa-file-export"></i> Exporter toutes les données
            </button>
        </div>
    </div>
</div>
<script>
    // Gestion des onglets
    document.addEventListener('DOMContentLoaded', function() {
        const tabs = document.querySelectorAll('.tab');
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
    });
</script>
@endsection