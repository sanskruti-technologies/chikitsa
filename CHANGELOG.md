# Change Log
All notable changes to this project will be documented in this file.
This project adheres to [Semantic Versioning](http://semver.org/).

## [0.7.6] - 2019-03-19
### Added
- Browse Extensions from Chikitsa
- List Master
### Changed
- Minor Changes

## [0.7.5] - 2019-02-11
### Changed
- Minor Changes

## [0.7.4] - 2019-01-04
### Added
- Auto referesh of Appointment Page
- Issue Refund from Patient Account
### Changed
- Minor Changes

## [0.7.3] - 2018-10-29
### Added
- Payment Methods
### Changed
- Minor Fixes
- Patient Selection in Bill Report

## [0.7.2] - 2018-10-18
### Added
- Blood Group in Patient
- CSS and JS minification

### Changed
- Do not allow to delete a user if Doctor

## [0.7.1] - 2018-09-19
### Added
- Blood Group in Patient

### Changed
- Compatible with PHP 7.2.9
- Disabled calendar dates on Holidays
- Next Followup date will not set for Holiday
- Appointment cannot be taken on Holiday
- Better Patient Reference Details

## [0.7.0] - 2018-08-20
### Changed
- Better Language Settings
- Folder Structure improved

## [0.6.9] - 2018-08-10
### Changed
- made compatible with PHP 7.2.x
- Correction in Reference By
- Allowing to store data in different languages

## [0.6.8] - 2018-07-27
### Changed
- Correction in Tax Report
- Correction in Print Bill
- Other Minor fixes


## [0.6.7] - 2018-07-17
### Changed
- Correction in Tax Report


## [0.6.6] - 2018-07-09
### Added
- Filter in Bill 
### Changed
- Taxes (Corrected problems)
- Tax Report
- Correction in Max Patient at a time logic
- Other minor fixes

## [0.6.5] - 2018-06-18
### Added
- Taxes 
### Changed
- Minor Fixes
- Flexible Time Interval for Appointments

## [0.6.4] - 2018-05-18
### Added
- Set Value. Retains enetered value in form in case of validation errors.
- More flexible intervals for Appointments*
### Changed
- Minor Fixes
- Check for Chikitsa Server Availability in Modules *
- Shifted Prescription in Edit Visit (requires Prescription Extension)*
- Correction in Backup Restore *
- Corrected some responsive behaviour *

## [0.6.3] - 2018-04-06
### Added
- Independent Billing System
- Patient Age Field
### Changed
- Minor Fixes

## [0.6.2] - 2018-03-31
### Changed
- Minor Fixes

## [0.6.1] - 2018-03-19
### Added
- Arabic Language
- French Language
- Advance Payment
- Adjust Payment from Account
- Patient Report
- Faster Loading of Patient List using AJAX

### Changed
- Added Patient Filter in Appointment Report
- Better Language Support
- Minor Fixes




## [0.6.0] - 2018-02-24
### Changed
- Minor Fixes
### Added



## [0.5.9] - 2018-01-26
### Changed
- Language files updated
- Minor Fixes
### Added
- Notice in Menu for new upgrades available.
- Delete option for Discount
- Allow to run Clinic 24 hours
- Display Clinic Name and Tag Line in Title

## [0.5.8] - 2018-01-03
### Changed
- Ajax for installing and updating Chikitsa
- Upgraded Codeigniter
- Minor Fixes
### Added
- One Click update for Chikitsa and Extensions with Active and Valid license

## [0.5.7] - 2017-10-02
### Added
- Add License Key for Module
- Improved Installation


## [0.5.6] - 2017-09-30
### Added
- Select Default Number in Patient
- Gender "Other"

## [0.5.5] - 2017-08-17
### Added
  - System Administrator Role (above Administrator)
  - Required Modules Check while activating a module
  
### Changed
  - Shifted Invoice Settings to Settings
  - Minor Fixes
  
## [0.5.4] - 2017-08-03
### Changed
  - Minor Fixes

  
## [0.5.3] - 2017-07-27
### Changed
  - Minor Fixes
### Added
  - One Click Update for Chikitsa (will be visible from next version)
  
## [0.5.2] - 2017-07-11
### Changed
  - Minor Fixes
  
## [0.5.1] - 2017-07-06
### Added
  - Multiple Contact Numbers in Patient
  - Numeric Validation in Bill Amounts
### Changed
  - Separate Page to add User instead of Above the table
  
  

## [0.5.0] - 2017-06-19
### Changed
  - Changes for new version of Medicine Store

## [0.4.9] - 2017-05-02
### Changed
  - Bill On Visit Page
  - Select Multiple Doctor on Bill Detail Report
 
## [0.4.8] - 2017-04-24
### Changed
 - Changes for Wamp Compatibility
 
## [0.4.7] - 2017-04-22
### Changed
  - Solved Error in Modules
 
## [0.4.6] - 2017-04-08
### Added
 - Title for Name
### Changed
 - Faster Loading
 - Correction in Responsive behaviour
 - Removal of Limit in uploading Backup
 
## [0.4.4] - 2017-03-22
### Added
 - Second Number for Patient
 - Comprehensive Reference Settings and Details (Settings > Reference By)
 - More Details can be added while adding patient in Add Appointment Form
### Changed
 - Added Totals in Excel Export for Bill Detail Report
 
## [0.4.3] - 2017-03-10
### Added
 - Ready for Followup Reminders Changes in Alert Extension
 - Ready for Import CSV - Import Patients
### Changed
 - Correction in Doctor Availability Validation Check


## [0.4.2] - 2017-02-21
### Changed
 - Correction in Link highlighting problems
 
## [0.4.1] - 2017-02-15
### Changed
 - Correction in Link highlighting problems
 - Correction in Error of Maximum Patient at a times
 - Correction in Followup Date Display

## [0.4.0] - 2017-01-28
### Changed
- Display Followups Doctorwise
- Corrected Highlight of Menu According to Active Page 
- View Appointment link in Appointment Report
- Limit Time Field in Visit Page according to Clinic Timings
- Allow to add Clinic Logo in Receipt (Requires Receipt Template to edit template)
- While restoring backup, check added for database prefix

## [0.3.9] - 2017-01-03
### Added
- Compatible for Marking 0.0.5
### Changed
- Logic corrected to check doctor's availability for booking appointment

## [0.3.8] - 2016-12-06
### Added
- Added Language Italian - Contribution Elis Hodo
- Print Appointment Report
- Print Bill Detail Report
- Limit Maximum Patients at a time

### Changed
- Added index.php again. (had to for some old servers)
- Appointments not properly showing for some timezones. Corrected.

## [0.3.7] - 2016-09-06
### Added
- Doctor's In-availability in Doctors Login (requires Doctor Extension)
- Holidays - Add holidays and working days
- Appointment & Visit Reason
- Add Inquiry . For patients that just call. Will be added to New Inquires.
- Total field added on Visit Page
- Total Due After Payment field added on Payment Page
### Changed
- Removed index.php from url. (doesnt seem so, but it is a big change)
- Error from login page removed.
- Error from Bill Report (Doctor's Login) removed.
- User Menu Hierarchy


## [0.3.6] - 2016-08-08
### Changed
- Bill Detail Report was not working for Doctor Login. Corrected.

## [0.3.5] - 2016-08-04
### Added
- Confirmation alert for deleting Payment
### Changed
- Followups were not being added. Corrected this.

## [0.3.4] - 2016-07-21
### Added
- Favicon
### Changed
- Email Search for Patient was showing mobile number on Add Appointment. Corrected this.

## [0.2.0] - 2015-10-06
### Changed
- Remove exclusionary mentions of "open source" since this project can benefit
both "open" and "closed" source projects equally.

## [0.1.0] - 2015-10-06
### Added
- Answer "Should you ever rewrite a change log?".

### Changed
- Improve argument against commit logs.
- Start following [SemVer](http://semver.org) properly.

## [0.0.8] - 2015-02-17
### Changed
- Update year to match in every README example.
- Reluctantly stop making fun of Brits only, since most of the world
  writes dates in a strange way.

### Fixed
- Fix typos in recent README changes.
- Update outdated unreleased diff link.

## [0.0.7] - 2015-02-16
### Added
- Link, and make it obvious that date format is ISO 8601.

### Changed
- Clarified the section on "Is there a standard change log format?".

### Fixed
- Fix Markdown links to tag comparison URL with footnote-style links.

## [0.0.6] - 2014-12-12
### Added
- README section on "yanked" releases.

## [0.0.5] - 2014-08-09
### Added
- Markdown links to version tags on release headings.
- Unreleased section to gather unreleased changes and encourage note
keeping prior to releases.

## [0.0.4] - 2014-08-09
### Added
- Better explanation of the difference between the file ("CHANGELOG")
and its function "the change log".

### Changed
- Refer to a "change log" instead of a "CHANGELOG" throughout the site
to differentiate between the file and the purpose of the file — the
logging of changes.

### Removed
- Remove empty sections from CHANGELOG, they occupy too much space and
create too much noise in the file. People will have to assume that the
missing sections were intentionally left out because they contained no
notable changes.

## [0.0.3] - 2014-08-09
### Added
- "Why should I care?" section mentioning The Changelog podcast.

## [0.0.2] - 2014-07-10
### Added
- Explanation of the recommended reverse chronological release ordering.

## [0.0.1] - 2012-11-04
### Added
- Patients  - Store Patient Details
			- Search Patients
- Appointments - Add Appointment
- Visits - Maintain Patient Visit Details
- Settings - Clinic Start Time / End Time  - To display Calendar
- Install Script