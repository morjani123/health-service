# Health Service V2 — Germany Healthcare Recruitment

React + TypeScript + Supabase candidate portal and administrator CRM.

## Production setup (required)
1. Create a Supabase project and run `supabase/schema.sql` in its SQL editor (on a fresh project).
2. Enable email confirmation and configure Site URL and redirect URLs for the GitHub Pages domain.
3. Add GitHub Actions repository **Variables** `VITE_SUPABASE_URL` and `VITE_SUPABASE_ANON_KEY` (publishable/anon key only, NEVER service_role).
4. The deployment workflow reads these variables during build. Re-run it after configuration.
5. Register your admin account via the site; then use trusted SQL editor to set role='admin' for that known user UUID. Never expose privileged keys in frontend.
6. Review GDPR/privacy, retention, consent, applicant data processing, secure documents and job-offer verification before inviting real applicants.

Until Supabase is configured, the public site works but the portal shows a setup notice and **does not collect candidate data**. Example job cards on the public site are illustrative, not verified jobs. The original WordPress history remains in Git history. No guarantee of job placement, visa or credential recognition.

## Local
`npm install && npm run build`

## Deploy
GitHub Actions → Deploy Health Service. Enable Pages source GitHub Actions.
