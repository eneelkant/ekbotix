<?php

declare(strict_types=1);

return [
    [
        'title' => 'AI Lead Triage Agent',
        'status' => 'Prototype',
        'problem' => 'Repetitive inbound lead sorting consumes operator time.',
        'approach' => 'LLM classification with confidence thresholds and human fallback.',
        'technology' => ['LLM APIs', 'n8n', 'CRM webhooks'],
        'workflow' => 'Webhook → enrich → classify → route / escalate',
        'result' => 'Demonstrates agentic triage patterns for marketing ops. Results not production-benchmarked. [VERIFY]',
    ],
    [
        'title' => 'MCP Tooling Experiments',
        'status' => 'Experiment',
        'problem' => 'Agents need safe, structured access to operational tools.',
        'approach' => 'Explore Model Context Protocol connections for controlled tool use.',
        'technology' => ['MCP', 'Cursor', 'API connectors'],
        'workflow' => 'Define tools → authorize → invoke → log → review',
        'result' => 'Research into agent-host integration patterns for marketing/engineering workflows.',
    ],
    [
        'title' => 'Reporting Narrative Assistant',
        'status' => 'Research',
        'problem' => 'Stakeholders need concise interpretations of dashboard changes.',
        'approach' => 'Pair Looker/BigQuery summaries with LLM narrative drafts under human edit.',
        'technology' => ['BigQuery', 'Looker Studio', 'LLM'],
        'workflow' => 'Query metrics → summarize deltas → draft narrative → analyst approve',
        'result' => 'Conceptual workflow; not claimed as a shipped production agent.',
    ],
    [
        'title' => 'Email Verification Pipeline (PHP)',
        'status' => 'Production',
        'problem' => 'Bad emails degrade automation quality.',
        'approach' => 'Independent PHP verifier modeled after Reacher’s staged checks.',
        'technology' => ['PHP', 'DNS', 'SMTP', 'JSON API'],
        'workflow' => 'Syntax → MX → SMTP → misc checks → classify',
        'result' => 'Shipped as Ekbotix product with API UI and tests. SMTP depends on host egress.',
    ],
];
