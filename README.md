# **PROJECT BLUEPRINT: BHANDARA**

### *The Sovereign Commerce Ecosystem*

---

## **1. Definition**

**Bhandara** (Sanskrit: *Storehouse* or *Treasury*) is a high-performance, multi-tenant Software-as-a-Service (SaaS) platform. It empowers individuals and small businesses to create their own sovereign digital commerce environments. Unlike generic marketplaces where sellers fight for attention, Bhandara provides every merchant with a dedicated, isolated dashboard and a personalized public storefront, allowing them to manage inventory, orders, and finances with the elegance of an enterprise ERP.

---

## **2. Background & Problem Statement**

* **The Chaos:** Small merchants currently rely on a fragmented stack of tools—Excel for stock, WhatsApp for negotiation, and cluttered marketplaces for visibility. They lack a "home base."
* **The Identity Crisis:** In big marketplaces (orange/green apps), the seller’s brand is drowned out by the platform's branding. They are just a commodity.
* **The Complexity Gap:** Professional ERPs and Shopify-like solutions are often too expensive or too complex for the local market context.
* **The Solution:** Bhandara bridges this gap by offering a "Private Treasury" for every merchant—simple enough to start, powerful enough to scale, and distinct enough to build a brand.

---

## **3. Vision & Mission**

### **Vision**

To become the digital foundation where modern commerce flows with order, clarity, and elegance—turning every chaotic shopkeeper into a disciplined merchant.

### **Mission**

1. **Sovereignty:** Give every merchant total control over their data and storefront appearance.
2. **Simplicity:** Specific logic wrapped in a beautiful UI to reduce cognitive load.
3. **Scalability:** Architecture built to handle one shop or one million shops without code restructuring.

---

## **4. Core Entities (The Data Architecture)**

We utilize a **Multi-Tenant Database Strategy** (Single Database, Tenant Column Isolation).

* **Global Entities (System Level)**
* `SuperAdmin`: The owner of Bhandara (You). Has access to all metrics and subscription controls.
* `Tenant (Shop)`: The core unit. Represents a store. Contains branding (logo, theme colors), slug (`/u/store-name`), and subscription status.
* `User (Merchant)`: The owner of a Tenant. One user can own multiple shops.


* **Tenant Entities (Scoped by Shop ID)**
* `Product`: SKU, Name, Stock, Price, Images, Visibility.
* `Category`: Hierarchical organization for products.
* `Order`: The transaction record (Pending -> Processing -> Completed).
* `Customer`: A lightweight record of who bought from the shop (CRM).
* `Transaction`: Proof of payments (Manual Transfer/Evidence upload).



---

## **5. User Flows**

### **A. The Merchant Journey (Tenant)**

1. **Registration:** User signs up `->` Creates a Shop (slug: `nexus-gear`) `->` System provisions the Tenant Dashboard.
2. **Setup:** Merchant accesses `bhandara.id/app` `->` Uploads Logo `->` Sets Color Theme `->` Configures Bank Account for transfers.
3. **Inventory:** Merchant creates `Product A` `->` Uploads images `->` Sets Stock (100) `->` Publishes.
4. **Fulfillment:** Notification arrives `->` Merchant views Order #1001 `->` Checks Payment Proof `->` Clicks "Approve" `->` Status changes to "Processing" `->` Inputs Tracking Number `->` Status "Shipped".

### **B. The Customer Journey (Public)**

1. **Discovery:** Customer visits `bhandara.id/u/nexus-gear`.
2. **Browsing:** Views custom Storefront (Tailwind styled) `->` Adds items to Cart.
3. **Checkout:** Inputs shipping address `->` Sees "Total: Rp 150.000" `->` Transfers manually to Merchant's Bank.
4. **Confirmation:** Customer uploads photo of transfer receipt `->` Submits Order `->` Receives "Waiting for Approval" status.

---

## **6. Modules & Features**

### **Module 1: The Fortress (Authentication & Tenancy)**

* **Multi-Tenancy:** Automatic scoping of all resources based on the active Shop.
* **Tenant Registration Flow:** Self-service shop creation.
* **Profile Management:** Shop Avatar, Banner, and Bio.

### **Module 2: The Treasury (Inventory Management)**

* **Product Resource:** Rich text description, image gallery, stock tracking.
* **Quick Adjustments:** Inline editing in tables to update stock/price rapidly.
* **Low Stock Alerts:** Dashboard widgets showing items nearing depletion.

### **Module 3: The Exchange (Order Management)**

* **The "Kanban" View:** Visualize orders moving from Pending `->` Paid `->` Shipped.
* **Evidence Verifier:** A dedicated modal to view payment proofs side-by-side with order totals.
* **Invoice Generator:** Auto-generate PDF invoices for customers.

### **Module 4: The Face (Public Storefront)**

* **Dynamic Theming:** Using Tailwind Play CDN to inject the Merchant's chosen primary colors into the CSS variables at runtime.
* **Responsive Layout:** Mobile-first design for customers.
* **Cart & Checkout:** Session-based cart system (no login required for buyers).

### **Module 5: The Overseer (Super Admin)**

* **Global Dashboard:** Total Shops, Total GMV (Gross Merchandise Value), System Health.
* **User Management:** Ban/Suspend non-compliant shops.
* **Announcement System:** Broadcast messages to all merchant dashboards.

---

## **7. Technology Stack**

This stack is chosen for maximum efficiency, modern standards, and your specific server environment.

* **Core Framework:** **Laravel 12** (Upcoming/Bleeding Edge).
* *Why:* To ensure the codebase remains relevant for the next 5 years.


* **Language:** **PHP 8.4+**.
* *Why:* Utilizing new Property Hooks and asymmetric visibility for cleaner classes.


* **Frontend Architecture:** **Laravel Blade Templates + Tailwind Play CDN**.
* *Why:* Clean monolith architecture with semantic nested tree structure (following LARAVELDEVCONV.md). Blade provides powerful templating with zero build step. Tailwind Play CDN allows instant, dynamic styling based on database values (e.g., Shop Color Hex) without needing a Node.js build step for every tenant. Perfect for a dynamic SaaS.


* **Architecture Pattern:** **Monolith dengan Semantic Nested Tree Structure**.
* *Why:* Following LARAVELDEVCONV.md standards for maximum scalability and predictability. Scope-first, domain-second organization eliminates flat directory chaos.


* **Database:** **MariaDB / MySQL**.
* *Why:* Rock-solid reliability for relational data.


* **Infrastructure:** **Ubuntu 24.04 LTS (VPS)**.
* *Server:* Nginx.
* *Process Manager:* Supervisor (for Queues).
* *CI/CD:* Manual/Git based (The "God Mode" terminal approach).



---

## **8. Final Summary**

**Bhandara** is not just a project; it is a statement of architectural capability. It demonstrates mastery over **Multi-Tenancy**, **State Management**, and **User Experience**.

By building this, you move from being a "developer who writes code" to a "Platform Architect who defines ecosystems." It allows you to practice the "High Profile, Low Noise" lifestyle—you provide the infrastructure, the merchants provide the noise and the transactions. You simply sit at the top, watching the metrics flow in the Super Admin panel.

**Status:** Ready for Development.
**Next Step:** Initialize the Laravel 12 repository.

---

