<?php

declare(strict_types=1);

/**
 * Portfolio projects. Use [VERIFY] / [VERIFY METRIC] for unconfirmed claims.
 * Do not invent employers, dates, or results.
 */

return [
    [
        'slug' => 'crm-lead-routing-automation',
        'title' => 'CRM Lead Routing & Campaign Automation',
        'category' => 'Marketing Automation',
        'summary' => 'Designed workflows that route inbound leads through CRM and marketing automation platforms with consistent scoring and handoff rules.',
        'problem' => 'Inbound leads were handled inconsistently across channels, creating delays and duplicate ownership.',
        'solution' => 'Mapped lead sources to automated routing rules, lifecycle stages, and campaign enrollment in CRM / Account Engagement–style stacks.',
        'technology' => ['Salesforce Account Engagement', 'HubSpot', 'CRM workflows', 'APIs'],
        'workflow' => 'Capture → normalize → score → route → enroll → notify owner',
        'impact' => '[VERIFY METRIC] Reduced manual assignment effort and improved time-to-first-touch consistency.',
        'role' => 'Marketing automation / MarTech specialist',
        'links' => [],
        'featured' => true,
    ],
    [
        'slug' => 'ga4-bigquery-reporting',
        'title' => 'GA4 → BigQuery → Looker Studio Reporting',
        'category' => 'Data & Analytics',
        'summary' => 'Connected analytics export and visualization so marketing operations can inspect funnel and channel performance without spreadsheet rebuilds.',
        'problem' => 'Reporting depended on fragile manual exports and one-off sheets.',
        'solution' => 'Used GA4 export patterns into BigQuery and Looker Studio dashboards for recurring operational reporting.',
        'technology' => ['GA4', 'BigQuery', 'Looker Studio', 'Google Search Console', 'Sheets'],
        'workflow' => 'Event collection → BigQuery → modeled views → Looker Studio → stakeholder review',
        'impact' => '[VERIFY METRIC] Faster recurring reporting cycles; fewer manual rebuilds.',
        'role' => 'Analytics & automation',
        'links' => [],
        'featured' => true,
    ],
    [
        'slug' => 'ai-lead-classification',
        'title' => 'AI-Assisted Lead Classification',
        'category' => 'AI Automation',
        'summary' => 'Prototype workflows that classify and prioritize leads using LLM-assisted rules before CRM enrollment.',
        'problem' => 'High-volume lead intake required repetitive triage that did not scale.',
        'solution' => 'Experimented with AI classification prompts and automation orchestration (n8n / Zapier-style) to tag and route leads.',
        'technology' => ['LLMs', 'n8n', 'Zapier', 'CRM APIs', 'Python'],
        'workflow' => 'Ingest lead → enrich context → classify → confidence gate → CRM update / human review',
        'impact' => '[VERIFY METRIC] Reduced repetitive triage for qualifying inbound interest.',
        'role' => 'AI automation experimenter',
        'links' => [],
        'featured' => true,
    ],
    [
        'slug' => 'apps-script-api-integrations',
        'title' => 'Google Apps Script & API Integrations',
        'category' => 'Integration Engineering',
        'summary' => 'Built lightweight integration layers connecting Sheets, Gmail/Workspace tooling, Slack notifications, and marketing platforms.',
        'problem' => 'Operations teams needed glue between tools without a full custom backend for every job.',
        'solution' => 'Implemented Apps Script and REST API connectors for sync, alerts, and operational automation.',
        'technology' => ['Google Apps Script', 'REST APIs', 'JSON', 'Slack', 'MailWizz', 'PHP'],
        'workflow' => 'Trigger → authenticate → transform payload → call API → log result → notify',
        'impact' => '[VERIFY METRIC] Replaced repetitive copy/paste between systems.',
        'role' => 'Integration engineer',
        'links' => [],
        'featured' => false,
    ],
    [
        'slug' => 'email-verifier-product',
        'title' => 'Ekbotix Email Verifier',
        'category' => 'Developer Projects',
        'summary' => 'Open PHP email verification product inspired by Reacher’s check-if-email-exists pipeline — syntax, DNS/MX, SMTP probes, disposable and role checks.',
        'problem' => 'Invalid and disposable emails pollute CRM and automation workflows.',
        'solution' => 'Independent PHP implementation of a staged verification pipeline with JSON API and product UI.',
        'technology' => ['PHP 8', 'DNS/MX', 'SMTP', 'JSON API', 'JavaScript'],
        'workflow' => 'Normalize → syntax → MX → SMTP → disposable/role → classify',
        'impact' => 'Working product under /products/email-verifier with test suite and hosting limitation documentation.',
        'role' => 'Builder / maintainer',
        'links' => [
            ['label' => 'Product', 'url' => '/products/email-verifier'],
            ['label' => 'Reference foundation', 'url' => 'https://github.com/reacherhq/check-if-email-exists'],
        ],
        'featured' => true,
    ],
];
