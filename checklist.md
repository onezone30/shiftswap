## ShiftSwap Checklist

### 1. Fix the project foundation
- [ ] Review and correct the migration order so dependent tables are created after their parent tables
- [ ] Fix the current Position schema mismatch between the model and migration
- [ ] Standardize table naming to Laravel-friendly plural names where needed
- [ ] Update the User schema so role, branch, and position relationships are valid
- [ ] Decide and document the initial user roles: employee, manager, admin
- [ ] Rebuild the database and confirm migrations run cleanly from scratch

### 2. Build the core data model
- [ ] Create a proper Shift model for actual dated work assignments
- [ ] Create a ShiftTemplate model for repeating weekly schedule patterns
- [ ] Create a ShiftSwapRequest model for swap workflow tracking
- [ ] Add all needed foreign keys for branch, position, assigned employee, requester, recipient, and approver
- [ ] Add status fields for swap lifecycle states
- [ ] Add audit-friendly timestamps for request, response, approval, rejection, and cancellation

### 3. Connect the model relationships
- [ ] Add branch, position, shift, swap, and notification relationships to User
- [ ] Expand Branch to manage users, managers, shifts, and templates
- [ ] Align Position with the corrected table and add shift-related relationships
- [ ] Add helper methods for role checks and branch scoping

### 4. Add authorization rules
- [ ] Create middleware or policies for role-based access
- [ ] Limit employees to their own schedules and requests
- [ ] Limit managers to schedules, approvals, and reports for their own branch
- [ ] Reserve branch and user administration for admin users if needed
- [ ] Verify same-branch and same-position swap restrictions are enforced

### 5. Build manager branch-management features
- [ ] Create CRUD for branches
- [ ] Create CRUD for positions
- [ ] Create CRUD for employees and manager accounts
- [ ] Add branch assignment and position assignment flows
- [ ] Seed Rebecca's Grocery branches: Bayanan, Putatan, Poblacion, and San Pedro

### 6. Build manager scheduling features
- [ ] Create schedule template management for weekly repeating shifts
- [ ] Create dated shift management for actual assigned schedules
- [ ] Add branch and week filters to schedule views
- [ ] Add create, edit, delete, and publish actions for schedules
- [ ] Add basic coverage validation to avoid empty staffing periods

### 7. Build employee schedule features
- [ ] Replace the placeholder dashboard with an employee schedule summary
- [ ] Add a weekly schedule page for employees
- [ ] Add a shift detail page showing branch, position, and schedule details
- [ ] Show pending, approved, rejected, and completed swap requests

### 8. Build the shift swap workflow
- [ ] Let an employee select one of their assigned shifts and request a swap
- [ ] Filter eligible coworkers to same branch and same position
- [ ] Let the receiving coworker accept or reject the request
- [ ] Move accepted requests into manager approval status
- [ ] Let the manager approve or reject the request
- [ ] Reassign the shift only after final manager approval
- [ ] Preserve a full audit trail of each decision

### 9. Build manager approval and reporting views
- [ ] Create a manager dashboard with pending approvals and branch staffing summary
- [ ] Add a pending approvals page
- [ ] Add a recent swap activity page
- [ ] Add simple reports for pending swaps, approved swaps, rejected swaps, and coverage gaps

### 10. Add notifications
- [ ] Enable in-app notifications using Laravel database notifications
- [ ] Enable email notifications for workflow changes
- [ ] Notify when a swap request is created
- [ ] Notify when a coworker accepts or rejects a request
- [ ] Notify when a manager approves or rejects a request
- [ ] Verify notification content is clear for both employees and managers

### 11. Build the UI flow
- [ ] Add role-aware navigation links for employees and managers
- [ ] Replace the generic dashboard with role-specific summaries
- [ ] Create manager pages for branches, staff, schedules, and approvals
- [ ] Create employee pages for schedule viewing and swap tracking
- [ ] Reuse existing Blade components and keep the UI consistent

### 12. Seed and demo the system
- [ ] Seed branches, positions, users, schedules, and sample swap requests
- [ ] Prepare demo accounts for employee, manager, and admin roles
- [ ] Prepare a Putatan pilot scenario for presentation and testing

### 13. Test everything
- [ ] Add feature tests for authentication and role access
- [ ] Add feature tests for branch scoping
- [ ] Add feature tests for schedule creation and editing
- [ ] Add feature tests for swap request creation and coworker response
- [ ] Add feature tests for manager approval and final shift reassignment
- [ ] Add feature tests for notification dispatch
- [ ] Run manual end-to-end tests for employee to manager workflow

### 14. Prepare deployment and rollout
- [ ] Write a project README specific to ShiftSwap instead of the default Laravel README
- [ ] Document setup, seed, and test commands
- [ ] Document branch-management and scheduling workflows for managers
- [ ] Document employee swap-request workflow
- [ ] Pilot at Putatan first, then onboard the other branches

### Done criteria
- [ ] Managers can manage branches, staff, templates, and schedules
- [ ] Employees can view schedules and request swaps
- [ ] Coworkers can accept or reject requests
- [ ] Managers can approve or reject accepted swaps
- [ ] Notifications work in-app and by email
- [ ] Reports show basic staffing and swap activity
- [ ] The system works for multiple branches dynamically