@extends('admin.template')

@section('title', 'Annonces')

@section('content')
<style>
    /* Filter Bar */
    .filter-bar {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 20px;
        background: white;
        padding: 15px 20px;
        border-radius: 10px;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.05);
    }

    .filter-group {
        display: flex;
        align-items: center;
    }

    .filter-group label {
        margin-right: 10px;
        font-size: 14px;
        color: var(--gray);
    }

    .filter-select {
        padding: 8px 15px;
        border: 1px solid #e0e0e0;
        border-radius: 5px;
        font-size: 14px;
        outline: none;
        margin-right: 15px;
        min-width: 150px;
    }

    .filter-select:focus {
        border-color: var(--primary);
    }

    .search-box {
        position: relative;
    }

    .search-box input {
        padding: 8px 15px 8px 35px;
        border: 1px solid #e0e0e0;
        border-radius: 20px;
        font-size: 14px;
        outline: none;
        transition: all 0.3s;
        min-width: 250px;
    }

    .search-box input:focus {
        border-color: var(--primary);
    }

    .search-box i {
        position: absolute;
        left: 12px;
        top: 50%;
        transform: translateY(-50%);
        color: var(--gray);
    }

    .btn {
        padding: 8px 15px;
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
        margin-right: 5px;
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

    /* Dispute Stats */
    .dispute-stats {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
        gap: 20px;
        margin-bottom: 20px;
    }

    .stat-card {
        background: white;
        border-radius: 10px;
        padding: 15px;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.05);
    }

    .stat-card-title {
        font-size: 14px;
        color: var(--gray);
        margin-bottom: 10px;
    }

    .stat-card-value {
        font-size: 22px;
        font-weight: 700;
        margin-bottom: 5px;
    }

    .stat-card-footer {
        font-size: 12px;
        color: var(--gray);
        display: flex;
        align-items: center;
    }

    .stat-card-footer.up {
        color: var(--danger);
    }

    .stat-card-footer.down {
        color: var(--success);
    }

    .stat-card-footer i {
        margin-right: 5px;
    }

    /* Disputes Table */
    .table-container {
        background: white;
        border-radius: 10px;
        padding: 20px;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.05);
        margin-bottom: 30px;
    }

    .table-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 20px;
    }

    .table-title {
        font-size: 18px;
        font-weight: 600;
    }

    table {
        width: 100%;
        border-collapse: collapse;
    }

    th,
    td {
        padding: 12px 15px;
        text-align: left;
        border-bottom: 1px solid #e0e0e0;
    }

    th {
        font-weight: 600;
        color: var(--dark);
        font-size: 14px;
    }

    td {
        font-size: 14px;
    }

    .dispute-type {
        padding: 5px 10px;
        border-radius: 20px;
        font-size: 12px;
        font-weight: 500;
    }

    .dispute-type.non-conforme {
        background-color: rgba(220, 53, 69, 0.2);
        color: #721c24;
    }

    .dispute-type.non-livre {
        background-color: rgba(255, 193, 7, 0.2);
        color: #856404;
    }

    .dispute-type.paiement {
        background-color: rgba(23, 162, 184, 0.2);
        color: #0c5460;
    }

    .dispute-type.autre {
        background-color: rgba(108, 117, 125, 0.2);
        color: #343a40;
    }

    .dispute-status {
        padding: 5px 10px;
        border-radius: 20px;
        font-size: 12px;
        font-weight: 500;
    }

    .dispute-status.en-cours {
        background-color: rgba(255, 193, 7, 0.2);
        color: #856404;
    }

    .dispute-status.resolu {
        background-color: rgba(40, 167, 69, 0.2);
        color: #155724;
    }

    .dispute-status.rejete {
        background-color: rgba(108, 117, 125, 0.2);
        color: #343a40;
    }

    .dispute-priority {
        display: inline-block;
        width: 12px;
        height: 12px;
        border-radius: 50%;
        margin-right: 5px;
    }

    .dispute-priority.high {
        background-color: var(--danger);
    }

    .dispute-priority.medium {
        background-color: var(--warning);
    }

    .dispute-priority.low {
        background-color: var(--success);
    }

    .actions{
        display: flex;
        align-items: center;
    }

    .action-btn {
        padding: 5px 10px;
        border-radius: 5px;
        border: none;
        background-color: var(--primary);
        color: white;
        cursor: pointer;
        font-size: 12px;
        transition: all 0.3s;
        margin-right: 5px;
    }

    .action-btn:hover {
        background-color: var(--secondary);
    }

    .action-btn.btn-view {
        background-color: var(--info);
    }

    .action-btn.btn-resolve {
        background-color: var(--success);
    }

    .action-btn.btn-reject {
        background-color: var(--danger);
    }

    /* Modal */
    .modal {
        display: none;
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background-color: rgba(0, 0, 0, 0.5);
        z-index: 1000;
        justify-content: center;
        align-items: center;
    }

    .modal-content {
        background-color: white;
        border-radius: 10px;
        width: 80%;
        max-width: 800px;
        max-height: 80vh;
        overflow-y: auto;
        padding: 20px;
        box-shadow: 0 5px 15px rgba(0, 0, 0, 0.3);
    }

    .modal-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 20px;
        padding-bottom: 10px;
        border-bottom: 1px solid #e0e0e0;
    }

    .modal-title {
        font-size: 20px;
        font-weight: 600;
        color: var(--dark);
    }

    .close-modal {
        background: none;
        border: none;
        font-size: 24px;
        cursor: pointer;
        color: var(--gray);
    }

    .dispute-details {
        margin-bottom: 20px;
    }

    .detail-row {
        display: flex;
        margin-bottom: 10px;
    }

    .detail-label {
        font-weight: 600;
        width: 150px;
        color: var(--gray);
    }

    .detail-value {
        flex: 1;
    }

    .message-container {
        margin-top: 20px;
    }

    .message {
        padding: 10px;
        border-radius: 5px;
        margin-bottom: 10px;
        background-color: #f8f9fa;
    }

    .message.sender {
        background-color: #e2f0fd;
        border-left: 3px solid var(--primary);
    }

    .message.receiver {
        background-color: #f0f0f0;
        border-left: 3px solid var(--gray);
    }

    .message-header {
        display: flex;
        justify-content: space-between;
        margin-bottom: 5px;
        font-size: 12px;
        color: var(--gray);
    }

    .response-area {
        margin-top: 20px;
    }

    .response-area textarea {
        width: 100%;
        padding: 10px;
        border: 1px solid #e0e0e0;
        border-radius: 5px;
        margin-bottom: 10px;
        min-height: 100px;
    }

    .modal-actions {
        display: flex;
        justify-content: flex-end;
        gap: 10px;
    }

    /* Pagination */
    .pagination {
        display: flex;
        justify-content: center;
        margin-top: 20px;
    }

    .pagination a {
        padding: 8px 15px;
        margin: 0 5px;
        border-radius: 5px;
        border: 1px solid #e0e0e0;
        color: var(--gray);
        text-decoration: none;
        transition: all 0.3s;
    }

    .pagination a.active,
    .pagination a:hover {
        background-color: var(--primary);
        color: white;
        border-color: var(--primary);
    }

    /* Responsive */
    @media (max-width: 1024px) {
        .filter-bar {
            flex-direction: column;
            align-items: flex-start;
        }

        .filter-group {
            margin-bottom: 10px;
            width: 100%;
            flex-wrap: wrap;
        }

        .search-box {
            width: 100%;
            margin-top: 10px;
        }

        .search-box input {
            width: 100%;
        }
    }

    @media (max-width: 768px) {
        table {
            display: block;
            overflow-x: auto;
        }

        .dispute-stats {
            grid-template-columns: 1fr 1fr;
        }

        .modal-content {
            width: 95%;
        }

        .detail-row {
            flex-direction: column;
        }

        .detail-label {
            width: 100%;
            margin-bottom: 5px;
        }
    }

    @media (max-width: 480px) {
        .dispute-stats {
            grid-template-columns: 1fr;
        }

        .modal-actions {
            flex-direction: column;
        }

        .modal-actions .btn {
            width: 100%;
            margin-bottom: 10px;
        }
    }
</style>
<!-- Filter Bar -->
<div class="filter-bar">
    <div class="filter-group">
        <label>Filtrer par :</label>
        <select class="filter-select">
            <option>Tous les litiges</option>
            <option>En cours</option>
            <option>Résolus</option>
            <option>Rejetés</option>
        </select>

        <select class="filter-select">
            <option>Tous types</option>
            <option>Article non conforme</option>
            <option>Livraison non reçue</option>
            <option>Problème de paiement</option>
            <option>Autre</option>
        </select>

        <select class="filter-select">
            <option>Toutes priorités</option>
            <option>Haute</option>
            <option>Moyenne</option>
            <option>Basse</option>
        </select>
    </div>

    <div class="search-box">
        <i class="fas fa-search"></i>
        <input type="text" placeholder="Rechercher un litige...">
    </div>
</div>

<!-- Dispute Stats -->
<div class="dispute-stats">
    <div class="stat-card">
        <div class="stat-card-title">Litiges Total</div>
        <div class="stat-card-value">48</div>
        <div class="stat-card-footer up">
            <i class="fas fa-arrow-up"></i> 5% ce mois
        </div>
    </div>
    <div class="stat-card">
        <div class="stat-card-title">En Cours</div>
        <div class="stat-card-value">23</div>
        <div class="stat-card-footer up">
            <i class="fas fa-arrow-up"></i> 3 en attente
        </div>
    </div>
    <div class="stat-card">
        <div class="stat-card-title">Résolus</div>
        <div class="stat-card-value">18</div>
        <div class="stat-card-footer down">
            <i class="fas fa-arrow-down"></i> 7% ce mois
        </div>
    </div>
    <div class="stat-card">
        <div class="stat-card-title">Taux de Résolution</div>
        <div class="stat-card-value">82%</div>
        <div class="stat-card-footer down">
            <i class="fas fa-arrow-down"></i> 5% ce mois
        </div>
    </div>
</div>

<!-- Disputes Table -->
<div class="table-container">
    <div class="table-header">
        <div class="table-title">Liste des Litiges</div>
        <div>
            <button class="btn btn-secondary">
                <i class="fas fa-file-export"></i> Exporter
            </button>
        </div>
    </div>
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Transaction</th>
                <th>Type</th>
                <th>Priorité</th>
                <th>Créé par</th>
                <th>Date</th>
                <th>Statut</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>#LIT-10045</td>
                <td>#TRX-78942 (35,000 FCFA)</td>
                <td><span class="dispute-type non-conforme">Article non conforme</span></td>
                <td><span class="dispute-priority high"></span> Haute</td>
                <td>Acheteur (Anna L.)</td>
                <td>12/06/2023</td>
                <td><span class="dispute-status en-cours">En cours</span></td>
                <td class="actions">
                    <button class="action-btn btn-view" onclick="openModal()"><i class="fas fa-eye"></i></button>
                    <button class="action-btn btn-resolve"><i class="fas fa-check"></i></button>
                    <button class="action-btn btn-reject"><i class="fas fa-times"></i></button>
                </td>
            </tr>
            <tr>
                <td>#LIT-10044</td>
                <td>#TRX-78938 (18,500 FCFA)</td>
                <td><span class="dispute-type non-livre">Livraison non reçue</span></td>
                <td><span class="dispute-priority high"></span> Haute</td>
                <td>Acheteur (Sophie T.)</td>
                <td>10/06/2023</td>
                <td><span class="dispute-status en-cours">En cours</span></td>
                <td class="actions">
                    <button class="action-btn btn-view" onclick="openModal()"><i class="fas fa-eye"></i></button>
                    <button class="action-btn btn-resolve"><i class="fas fa-check"></i></button>
                    <button class="action-btn btn-reject"><i class="fas fa-times"></i></button>
                </td>
            </tr>
            <tr>
                <td>#LIT-10043</td>
                <td>#TRX-78935 (42,000 FCFA)</td>
                <td><span class="dispute-type paiement">Problème de paiement</span></td>
                <td><span class="dispute-priority medium"></span> Moyenne</td>
                <td>Vendeur (Sarah J.)</td>
                <td>08/06/2023</td>
                <td><span class="dispute-status resolu">Résolu</span></td>
                <td class="actions">
                    <button class="action-btn btn-view" onclick="openModal()"><i class="fas fa-eye"></i></button>
                </td>
            </tr>
            <tr>
                <td>#LIT-10042</td>
                <td>#TRX-78932 (15,000 FCFA)</td>
                <td><span class="dispute-type autre">Autre</span></td>
                <td><span class="dispute-priority low"></span> Basse</td>
                <td>Acheteur (Paul A.)</td>
                <td>05/06/2023</td>
                <td><span class="dispute-status rejete">Rejeté</span></td>
                <td class="actions">
                    <button class="action-btn btn-view" onclick="openModal()"><i class="fas fa-eye"></i></button>
                </td>
            </tr>
            <tr>
                <td>#LIT-10041</td>
                <td>#TRX-78928 (25,000 FCFA)</td>
                <td><span class="dispute-type non-conforme">Article non conforme</span></td>
                <td><span class="dispute-priority high"></span> Haute</td>
                <td>Acheteur (Marie K.)</td>
                <td>03/06/2023</td>
                <td><span class="dispute-status resolu">Résolu</span></td>
                <td class="actions">
                    <button class="action-btn btn-view" onclick="openModal()"><i class="fas fa-eye"></i></button>
                </td>
            </tr>
        </tbody>
    </table>

    <!-- Pagination -->
    <div class="pagination">
        <a href="#"><i class="fas fa-angle-left"></i></a>
        <a href="#" class="active">1</a>
        <a href="#">2</a>
        <a href="#">3</a>
        <a href="#"><i class="fas fa-angle-right"></i></a>
    </div>
</div>
</div>

<!-- Modal -->
<div class="modal" id="disputeModal">
    <div class="modal-content">
        <div class="modal-header">
            <h3 class="modal-title">Détails du Litige #LIT-10045</h3>
            <button class="close-modal" onclick="closeModal()">&times;</button>
        </div>

        <div class="dispute-details">
            <div class="detail-row">
                <div class="detail-label">Transaction:</div>
                <div class="detail-value">#TRX-78942 - Table basse en bois (35,000 FCFA)</div>
            </div>
            <div class="detail-row">
                <div class="detail-label">Type:</div>
                <div class="detail-value"><span class="dispute-type non-conforme">Article non conforme</span></div>
            </div>
            <div class="detail-row">
                <div class="detail-label">Priorité:</div>
                <div class="detail-value"><span class="dispute-priority high"></span> Haute</div>
            </div>
            <div class="detail-row">
                <div class="detail-label">Créé par:</div>
                <div class="detail-value">Anna Lawson (Acheteur)</div>
            </div>
            <div class="detail-row">
                <div class="detail-label">Contre:</div>
                <div class="detail-value">David Koffi (Vendeur)</div>
            </div>
            <div class="detail-row">
                <div class="detail-label">Date:</div>
                <div class="detail-value">12/06/2023 à 14:30</div>
            </div>
            <div class="detail-row">
                <div class="detail-label">Statut:</div>
                <div class="detail-value"><span class="dispute-status en-cours">En cours</span></div>
            </div>
            <div class="detail-row">
                <div class="detail-label">Description:</div>
                <div class="detail-value">La table livrée ne correspond pas à la description. Elle est plus petite que les dimensions annoncées et présente des rayures sur la surface.</div>
            </div>
        </div>

        <div class="message-container">
            <h4>Historique des Messages</h4>

            <div class="message sender">
                <div class="message-header">
                    <span>Anna Lawson (Acheteur)</span>
                    <span>12/06/2023 14:30</span>
                </div>
                <p>Bonjour, je viens de recevoir la table mais elle ne correspond pas du tout à la description. Elle est beaucoup plus petite et présente des défauts visibles.</p>
            </div>

            <div class="message receiver">
                <div class="message-header">
                    <span>David Koffi (Vendeur)</span>
                    <span>12/06/2023 15:45</span>
                </div>
                <p>Je suis surpris de votre message. La table était en parfait état lorsque je l'ai envoyée. Avez-vous des photos des défauts ?</p>
            </div>

            <div class="message sender">
                <div class="message-header">
                    <span>Anna Lawson (Acheteur)</span>
                    <span>12/06/2023 16:20</span>
                </div>
                <p>Voici les photos des défauts : [lien vers les photos]. Vous pouvez clairement voir que les dimensions ne correspondent pas à l'annonce (90cm au lieu de 120cm).</p>
            </div>
        </div>

        <div class="response-area">
            <h4>Réponse du Médiateur</h4>
            <textarea placeholder="Écrivez votre réponse ou décision ici..."></textarea>

            <div class="modal-actions">
                <button class="btn btn-secondary" onclick="closeModal()">
                    <i class="fas fa-times"></i> Annuler
                </button>
                <button class="btn btn-resolve">
                    <i class="fas fa-check"></i> Résoudre en faveur de l'acheteur
                </button>
                <button class="btn btn-reject">
                    <i class="fas fa-times"></i> Résoudre en faveur du vendeur
                </button>
            </div>
        </div>
    </div>
</div>
<script>
    // Animation pour le chargement des lignes du tableau
    document.addEventListener('DOMContentLoaded', function() {
        const tableRows = document.querySelectorAll('tbody tr');
        tableRows.forEach((row, index) => {
            setTimeout(() => {
                row.style.opacity = '1';
                row.style.transform = 'translateX(0)';
            }, index * 50);
        });

        // Effet hover sur les lignes du tableau
        tableRows.forEach(row => {
            row.addEventListener('mouseenter', () => {
                row.style.backgroundColor = '#f8f9fa';
            });
            row.addEventListener('mouseleave', () => {
                row.style.backgroundColor = '';
            });
        });
    });

    // Gestion du modal
    function openModal() {
        document.getElementById('disputeModal').style.display = 'flex';
    }

    function closeModal() {
        document.getElementById('disputeModal').style.display = 'none';
    }

    // Fermer le modal en cliquant à l'extérieur
    window.onclick = function(event) {
        const modal = document.getElementById('disputeModal');
        if (event.target === modal) {
            closeModal();
        }
    }
</script>
@endsection