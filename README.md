<p align="center"><strong>ShiftSwap</strong></p>

# ShiftSwap – Workforce Scheduling & Shift Swap Portal

> A web-based workforce management platform for Rebecca’s Grocery Store and Merchandise, designed for dynamic scheduling, digital shift swaps, and streamlined manager approvals. Built with Laravel 13, Tailwind CSS, and Pest.

---

## Project Overview

ShiftSwap is a specialized scheduling and shift swap portal for small and medium retail businesses, piloted at Rebecca’s Grocery Store (Putatan, Philippines). It replaces manual scheduling and ad-hoc messaging with a digital platform that:

- Lets employees view their weekly schedules and request shift swaps with qualified coworkers
- Requires coworker acceptance and manager approval for all swaps, ensuring proper staffing
- Empowers managers to create, edit, and monitor schedules for multiple branches
- Provides both in-app and email notifications for all workflow events
- Supports dynamic branch and position management for future expansion

## Key Features

- **Multi-Branch Support:** Manage schedules and staff for multiple store locations
- **Role-Based Access:** Employees, managers, and admins with scoped permissions
- **Schedule Viewing:** Employees see their assigned shifts in a weekly calendar
- **Instant Shift Exchange:** Employees can request swaps with eligible coworkers (same branch/position)
- **Approval Workflow:** Swaps require coworker consent and manager approval
- **Manager Tools:** Create/edit schedules, assign staff, monitor coverage, and review swap requests
- **Notifications:** In-app and email alerts for requests, approvals, and changes
- **Reporting:** Basic analytics for staffing, swap activity, and coverage gaps

## Technical Stack

- **Backend:** Laravel 13 (PHP 8.3)
- **Frontend:** Blade templates, Tailwind CSS, Alpine.js
- **Database:** MySQL or compatible
- **Testing:** Pest (feature and unit tests)
- **Notifications:** Laravel notifications (database + email)

## Database Structure (Core Tables)

- `branches`: Store locations (name, address)
- `positions`: Job roles (e.g., cashier, bagger)
- `users`: Employees and managers (linked to branch and position)
- `shifts`: Dated work assignments (branch, position, user, start/end)
- `shift_swaps`: Swap requests (shift, requester, recipient, manager, status, audit trail)

## Main User Flows

1. **Manager creates schedules** for each branch and position
2. **Employee views schedule** and, if needed, requests a swap for a shift
3. **Coworker receives swap request** and accepts or rejects
4. **Manager reviews pending swaps** and approves or rejects
5. **Notifications** are sent at each step (request, response, approval)
6. **Reports** help managers monitor coverage and swap activity

## Business Context

- **Client:** Rebecca’s Grocery Store and Merchandise (Putatan, Bayanan, Poblacion, San Pedro)
- **Founder:** Rebecca Reyes (Santos)
- **Branch Manager:** Mrs. Maria Lourdes Ramos
- **Assistant Manager:** Mr. Anthony Miguel Villanueva

## Getting Started

1. Clone the repository
2. Run `composer install` and `npm install`
3. Copy `.env.example` to `.env` and set up your database credentials
4. Run `php artisan migrate --seed` to set up tables and demo data
5. Run `npm run dev` and `php artisan serve` to start the app

## Development & Testing

- Feature and unit tests: `php artisan test` or `./vendor/bin/pest`
- Database seeding: `php artisan db:seed`
- Code linting: `./vendor/bin/pint`

## License

This project is open-sourced under the MIT license.
