<p>An “AI agent” for marketing is not a chatbot bolted onto a landing page. It is a loop: observe context, choose a tool, act, evaluate, and either continue or escalate to a human.</p>

<h2>Patterns that work</h2>
<ul>
    <li><strong>Narrow tools</strong> — CRM update, Slack notify, sheet append — not unbounded browser control.</li>
    <li><strong>Confidence gates</strong> — low-confidence classifications never auto-enroll campaigns.</li>
    <li><strong>Audit logs</strong> — every automated action should be reconstructible.</li>
    <li><strong>Human review</strong> — especially for customer-facing sends and irreversible deletes.</li>
</ul>

<h2>Stack reality</h2>
<p>Practical agent builds often sit on orchestration layers (n8n, Zapier), CRM webhooks, and LLM APIs, with MCP-style tool exposure when the host environment supports it. The hard part is product thinking: defining the job boundary so the agent cannot wander into unsafe actions.</p>

<p>Projects in the Ekbotix AI Lab explore these patterns as prototypes and experiments. Production claims require production evidence — status labels exist for that reason.</p>
