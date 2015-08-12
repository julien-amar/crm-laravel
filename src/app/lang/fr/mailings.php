<?php

return array(
    'form.mailing.title' => 'Mailing',

    'grid.columns.client' => 'Client',
    'grid.columns.email' => 'Email',
    'grid.columns.state' => 'Status',
    'grid.columns.date' => 'Date',
    'grid.columns.action' => 'Action',

    'grid.actions.retry' => 'Renvoyer',
    'grid.actions.retry.description' => "Une erreur est survenue lors de l'envoie, cliquez pour l'envoyer de nouveau.",
    'grid.actions.delete' => 'Supprimer',
    'grid.actions.delete.description' => "Une erreur est survenue lors de l'envoie, cliquez pour supprimer ce mailing.",

    'form.create.fields.subject' => 'Sujet',
    'form.create.fields.subject.default' => 'Sujet',
    'form.create.fields.operation' => "Type d'opération",
    'form.create.fields.operation.default' => "Type d'opération",
    'form.create.fields.reference' => 'Reference',
    'form.create.fields.reference.default' => 'Reference',
    'form.create.fields.message' => 'Message',
    'form.create.fields.message.default' => 'Message',

    'form.create.fields.operations.100-BaissePrix' => 'Baisse de prix',
    'form.create.fields.operations.100-NouveauBilan' => 'Nouveau bilan',
    'form.create.fields.operations.200-Autre' => 'Autre...',

    'form.create.fields.file' => 'Ajouter un fichier',

    'form.create.action.close' => 'Annuler',
    'form.create.action.send' => 'Envoyer',

    'form.delete.title' => 'Suppression',
    'form.delete.label' => 'Êtes-vous certain de vouloir supprimer cet envoi ?',
    'form.delete.submit' => 'Supprimer',

    'validation.send.success' => 'Mailing had been created successfully.',
    'validation.retry.success' => "L'envoi a été mis à jour avec succès.",
    'validation.delete.success' => "L'envoi a supprimé avec succès.",
);
