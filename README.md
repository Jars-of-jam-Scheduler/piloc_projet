This project is an oAuth Passport CRUD App that allow landlords to CRUD residences. Admins users exist too.

Admin can CRUD residences and landlords. It is not possible for an admin to attach landlords to residences for the moment but two routes are created in prevision.

Landlords can CRUD residences if they own them (please see the gates).

# Getters

I have used the API Resources to show the data of the getters in the format you have asked.

# Authentication and Authorization

I have used manual authentication (with the security-aim session regeneration method call), which is defined in the Web routes for oAuth Authorization step.
Authorization is implemented using Laravel Passport. A VueJs front project has been partly written previously to this technical assessment and was continued in the end of this assessment.

As Web routes are needed for oAuth Authorization step (the authentication form to be shown to VueJs), this Laravel app is not accessible only in JSON, contradicting the technical assessment presentation message.

# CRUD

CRUD operations are written with API Resource Controllers, Form Requests and Gates.
Migrations, seeders, factories are written for tests for example.

# Tests

Only two tests have been written because I lacked time. I hope you'll find them as pertinent as I do:
- An admin wants to update a residence. Please note the database and errors sessions assertions.
- A future landlord wants to create his account. Only the status is tested, by lack of time.

IMPORTANT:
This API could not be tested, I have only had the time to write the code. The reason is: I lacked time.
I apologize.

# Middlewares, Services Providers, Custom bindings

I didn't need them.

# Eloquent

Models and their relationships are written.

# Routes

I have used API Resource Controllers routes, protected by my customer `auth:api` guard.
And other routes too. Please note the use of "routes constraints" for the 2 commented routes (commented because lack of time)