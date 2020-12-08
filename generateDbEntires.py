import random

maxRecords = 100000

male_f_names = ("Chris", "Tahan", "James", "John", "Robert", "Michael", "William", "David",
"Richard", "Joseph", "Thomas", "Charles", "Christopher", "Daniel", "Matthew", "Anthony", "Donald",
"Mark", "Paul", "Steven", "Andrew", "Kenneth", "Joshua", "Kevin", "Brian", "George", "Edward",
"Ronald", "Timothy", "Jason", "Jeffrey", "Ryan", "Jacob", "Gary", "Nicholas", "Eric", "Jonathan",
"Stephen", "Larry", "Justin", "Scott", "Brandon", "Benjamin", "Samuel", "Frank", "Gregory",
"Raymond", "Alexander", "Patrick", "Jack", "Dennis", "Jerry", "Tyler", "Aaron", "Jose", "Henry",
"Adam", "Douglas", "Nathan", "Peter", "Zachary", "Kyle", "Walter", "Harold", "Jeremy", "Ethan",
"Carl", "Keith", "Roger", "Gerald", "Christian", "Terry", "Sean", "Arthur", "Austin", "Noah",
"Lawrence", "Jesse", "Joe", "Bryan", "Billy", "Jordan", "Albert", "Dylan", "Bruce", "Willie",
"Gabriel", "Alan", "Juan", "Logan", "Wayne", "Ralph", "Roy", "Eugene", "Randy", "Vincent",
"Russell", "Louis", "Philip", "Bobby", "Johnny", "Bradley")

female_f_names = ("Janice", "Hilary", "Mary", "Patricia", "Jennifer", "Linda", "Elizabeth",
"Barbara", "Susan", "Jessica", "Sarah", "Karen", "Nancy", "Lisa", "Margaret", "Betty", "Sandra",
"Ashley", "Dorothy", "Kimberly", "Emily", "Donna", "Michelle", "Carol", "Amanda", "Melissa",
"Deborah", "Stephanie", "Rebecca", "Laura", "Sharon", "Cynthia", "Kathleen", "Amy", "Shirley",
"Angela", "Helen", "Anna", "Brenda", "Pamela", "Nicole", "Samantha", "Katherine", "Emma",
"Ruth", "Christine", "Catherine", "Debra", "Rachel", "Carolyn", "Janet", "Virginia", "Maria",
"Heather", "Diane", "Julie", "Joyce", "Victoria", "Kelly", "Christina", "Lauren", "Joan",
"Evelyn", "Olivia", "Judith", "Megan", "Cheryl", "Martha", "Andrea", "Frances", "Hannah",
"Jacqueline", "Ann", "Gloria", "Jean", "Kathryn", "Alice", "Teresa", "Sara", "Janice",
"Doris", "Madison", "Julia", "Grace", "Judy", "Abigail", "Marie", "Denise", "Beverly",
"Amber", "Theresa", "Marilyn", "Danielle", "Diana", "Brittany", "Natalie", "Sophia",
"Rose", "Isabella", "Alexis", "Kayla", "Charlotte")

lnames = ("Towler", "Smith", "Johnson", "Williams", "Brown", "Jones", "Garcia", "Miller", "Davis", "Rodriguez",
"Martinez", "Hernandez", "Lopez", "Gonzalez", "Wilson", "Anderson", "Thomas", "Taylor", "Moore",
"Jackson", "Martin", "Lee", "Perez", "Thompson", "White", "Harris", "Sanchez" ,"Clark", "Ramirez",
"Lewis", "Robinson" ,"Walker", "Young", "Allen", "King", "Wright", "Scott", "Torres", "Hill",
"Flores", "Green", "Adams", "Nelson", "Baker", "Hall", "Rivera", "Campbell", "Mitchell", "Carter", "Roberts")

occupations = ("Able Seamen", "Account Collector", "Accounting Specialist", "Adjustment Clerk", "Administrative Assistant", "Administrative Law Judge", "Administrative Service Manager",
"Admiralty Lawyer", "Adult Literacy and Remedial Education Teachers", "Advertising Account Executive", "Advertising Agency Coordinator", "Aeronautical & Aerospace Engineer",
"Aerospace Engineering Technician", "Agricultural Crop Farm Manager", "Agricultural Engineer", "Agricultural Equipment Operator", "Agricultural Inspector", "Agricultural Product Sorter", "Agricultural Sciences Professor",
"Agricultural Technician", "Air Crew Member", "Air Crew Officer", "Air Traffic Controller", "Aircraft Assembler", "Aircraft Body and Bonded Structure Repairer", "Aircraft Cargo Handling Supervisor",
"Aircraft Examiner", "Aircraft Launch and Recovery Officer", "Aircraft Launch and Recovery Specialist", "Aircraft Mechanic", "Airfield Operations Specialist", "Airline Flight Attendant",
"Airline Flight Control Administrator", "Airline Flight Operations Administrator", "Airline Flight Reservations Administrator", "Airport Administrator", "Airport Design Engineer",
"Alcohol & Drug Abuse Assistance Coordinator", "Alumni Relations Coordinator", "Ambulance Drivers", "Amusement Park & Recreation Attendants", "Anesthesiologist (MD)", "Animal Breeder", "Animal Control Worker",
"Animal Husbandry Worker Supervisor", "Animal Keepers and Groomers", "Animal Kennel Supervisor", "Animal Scientist", "Animal Trainer", "Animation Cartoonist", "Answering Service Operator", "Anthropology and Archeology Professor",
"Anti-Terrorism Intelligence Agent", "Appeals Referee", "Aquaculturist (Fish Farmer)", "Aquarium Curator", "Architecture Professor", "Armored Assault Vehicle Crew Member",
"Armored Assault Vehicle Officer", "Art Appraiser", "Art Director", "Art Restorer", "Art Therapist", "Artillery and Missile Crew Member", "Artillery and Missile Officer", "Artists Agent (Manager)",
"Athletes' Business Manager", "Athletic Coach", "Athletic Director", "Athletic Trainer", "ATM Machine Servicer", "Atmospheric and Space Scientist", "Audio-Visual Collections Specialist", "Audiovisual Production Specialist", "Automobile Mechanic", "Automotive Body Repairer",
"Automotive Engineer", "Automotive Glass Installer", "Avionics Technician", "Baggage Porters and Bellhops", "Baker (Commercial)", "Ballistics Expert", "Bank and Branch Managers", "Bank Examiner", "Bank Teller", "Benefits Manager", "Bicycle Mechanic", "Billing Specialist",
"Bindery Machine Set-Up Operators", "Bindery Machine Tender", "Biological Technician", "Biology Professor", "Biomedical Engineer", "Biomedical Equipment Technician", "Boat Builder", "Book Editor", "Border Patrol Agent", "Brattice Builder", "Bridge and Lock Tenders", "Broadcast News Analyst", "Broadcast Technician",
"Broker's Floor Representative", "Brokerage Clerk", "Budget Accountant", "Budget Analyst", "Building Inspector", "Building Maintenance Mechanic", "Bulldozer / Grader Operator", "Bus and Truck Mechanics", "Bus Boy / Bus Girl", "Bus Driver (School)", "Bus Driver (Transit)", "Business Professor", "Business Service Specialist", "Cabinet Maker",
"Camp Director", "Caption Writer", "Cardiologist (MD)", "Cardiopulmonary Technologist", "Career Counselor", "Cargo and Freight Agents", "Carpenter's Assistant", "Carpet Installer", "Cartographer (Map Scientist)", "Cartographic Technician", "Cartoonist (Publications)", "Casino Cage Worker", "Casino Cashier", "Casino Dealer", "Casino Floor Person",
"Casino Manager", "Casino Pit Boss", "Casino Slot Machine Mechanic", "Casino Surveillance Officer", "Casting Director", "Catering Administrator", "Ceiling Tile Installer", "Cement Mason", "Ceramic Engineer", "Certified Public Accountant (CPA)", "Chemical Engineer", "Chemical Equipment Operator",
"Chemical Plant Operator", "Chemical Technicians", "Chemistry Professor", "Chief Financial Officer", "Child Care Center Administrator", "Child Care Worker", "Child Life Specialist", "Child Support Investigator", "Child Support Services Worker", "City Planning Aide", "Civil Drafter", "Civil Engineer", "Civil Engineering Technician", "Clergy Member (Religious Leader)",
"Clinical Dietitian", "Clinical Psychologist", "Clinical Sociologist", "Coatroom and Dressing Room Attendants", "College/University Professor", "Commercial Designer", "Commercial Diver", "Commercial Fisherman", "Communication Equipment Mechanic", "Communications Professor", "Community Health Nurse", "Community Organization Worker", "Community Welfare Worker",
"Compensation Administrator", "Compensation Specialist", "Compliance Officer", "Computer Aided Design (CAD) Technician", "Computer and Information Systems Managers", "Computer Applications Engineer", "Computer Controlled Machine Tool Operators", "Computer Customer Support Specialist", "Computer Hardware Technician",
"Computer Operators", "Computer Programmer", "Computer Science Professor", "Computer Security Specialist", "Computer Software Engineers", "Computer Software Technician", "Computer Systems Engineer", "Congressional Aide", "Conservation Scientist", "Construction Driller", "Construction Laborer", "Construction Manager", "Construction Trades Supervisor", "Contract Administrator",
"Contract Specialist", "Control Center Specialist (Military)", "Controller (Finance)", "Cook (Cafeteria)", "Cook (Fast Food)", "Cook (Private Household)", "Cook (Restaurant)", "Cook (Short Order)", "Copy Writer", "Corporation Lawyer", "Correction Officer", "Correspondence Clerk", "Cosmetologist (Hair Stylist)", "Cost Accountant", "Cost Analysis Engineer", "Cost Estimator",
"Costume Attendant", "Counseling Psychologist", "Counter and Rental Clerks", "County or City Auditor", "Couriers and Messengers", "Court Administrator", "Court Clerk", "Court Reporter", "Craft Artist", "Crane Operator", "Credit Adjuster", "Credit Analyst", "Credit Reporter", "Criminal Investigator (Detective)", "Criminal Justice Professor", "Criminal Lawyer", "Crop Workers Supervisor",
"Crossing Guard", "Custom Tailor", "Customer Service Representative (Utilities)", "Customer Service Supervisor", "Customs Inspector", "Cutting Machine Operators", "Dairy Technologist", "Database Administrator", "Deaf Students Teacher", "Delivery Driver", "Demonstrators and Product Promoters", "Dental / Orthodontic Office Administrator", "Dental Assistant", "Dental Hygienist", "Dental Laboratory Technician",
"Dentist (MD)", "Dermatologist (MD)", "Desktop Publishing Specialist", "Developmental Psychologist", "Die Cutter Operator", "Dietetic Technician", "Dietitian and Nutritionist", "Directory Assistance Operator", "Disabled Students Teacher", "Disk Jockey", "Dispatcher (Safety Vehicles)", "Door To Door Salesmen", "Dry Wall Installer", "Economics Professor", "Education and Training Administrator", "Education Professor",
"Educational Administrator", "Educational Psychologist", "Educational Resource Coordinator", "Educational Therapist", "EEG Technician/Technologist", "Electric Meter Installer", "Electric Motor Mechanic", "Electrical and Electronic Inspector", "Electrical Drafter", "Electrical Engineers", "Electrical Parts Reconditioner", "Electrical Technician", "Electro-Mechanical Technicians", "Electromechanical Equipment Assembler", "Electronic Drafter", "Electronics Engineer",
"Electronics Technician", "Elementary School Administrator", "Elementary School Teacher", "Elevator Mechanic", "Emergency Management Specialist", "Emergency Medical Technician", "Employee Benefits Analyst", "Employee Training Instructor", "Employment Administrator", "Employment and Placement Specialist", "Employment Interviewer", "Engine and Machine Assemblers", "Engineering Managers", "Engineering Professor", "English Language and Literature Professor", "Environmental Compliance Inspector", "Environmental Disease Analyst", "Environmental Engineer",
"Environmental Planner", "Environmental Research Analyst", "Environmental Science Technician", "Environmental Science Professsor", "Environmental Technician", "Equal Opportunity Representative", "Etchers and Engravers", "Excavating Machine Operator", "Excavating Supervisor", "Executive Secretary", "Exercise Physiologist", "Exhibit Artist", "Exhibit Designer", "Experimental Psychologist", "Explosives Worker", "Export Agent", "Fabric and Apparel Patternmakers", "Facilities Planner", "Factory Layout Engineer", "Family Caseworker", "Family Practitioner (MD)", "Farm Equipment Mechanic", "Farm Hand", "Farm Labor Contractor", "Farm Manager", "Farm Products Purchasing Agent", "Farmers and Ranchers", "Fashion Artist", "Fashion Coordinator", "Fashion Designer", "Fashion Model", "Fence Installer", "Field Contractor", "Field Health Officer", "File Clerk", "Film Editor", "Film Laboratory Technician", "Finance Manager", "Financial Aid Counselor", "Financial Analyst", "Financial Examiner", "Financial Planner", "Financial Services Sales Agent", "Fine Artist", "Fire Inspector", "Fire Investigator", "Fire Prevention Engineer", "Fire Protection Engineer", "Fire Protection Engineering Technician", "Fish & Game Warden", "Fish Hatchery Specialist", "Fishery Worker Supervisor", "Fitness Trainer", "Flight Engineers", "Floral Designer", "Food & Drug Inspector", "Food Batchmaker", "Food Preparation Worker", "Food Science Technicians", "Food Technologist", "Foreign Exchange Trader", "Foreign Language Interpreter", "Foreign Language Teacher", "Foreign Language Translator", "Foreign Service Officer", "Foreign Service Peacekeeping Specialist", "Foreign Student Adviser", "Forensic Science Technicians", "Forensics Psychologist", "Forest and Conservation Technician", "Forest Engineer", "Forest Fire Prevention Supervisor", "Forest Fire Inspector", "Forestry and Conservation Professor", "Forging Machine Operator", "Forklift and Industrial Truck Operators", "Fraud Investigator", "Freight and Stock Handler", "Fund Raiser", "Funds Development Administrator", "Funeral Attendant", "Funeral Director", "Furniture Designer", "Furniture Finishers", "Game Runner", "Gas Plant Operator", "General and Operations Managers", "General Farmworkers", "General Internists (MD)", "Geography Professor", "Geological Data Technicians", "Geological Technician (Drafter)", "Glass Blower", "Gluing Machine Operators", "Golf Course Superintendent", "Government Budget Analyst", "Government Property Inspectors", "Government Service Executives", "Graduate Teaching Assistant", "Graphic Designer", "Greenhouse and Nursery Manager", 
"Gynecologist (MD)", "Hand and Portable Tool Mechanic", "Hand Sewer", "Harbor Master", "Hardwood Floor Finisher", "Hazardous Materials Removal Worker", "Hazardous Waste Management Analyst", "Health Care Facilities Inspector", "Health Case Manager", "Health Educators", "Health Psychologist", "Hearing Officer", "Heavy Equipment Mechanic", "High School Administrator", "High School Guidance Counselor", "High School Teacher", "Highway Maintenance Worker", "Highway Patrol Pilot", "Historic Site Administrator", "Historical Archivist", "History Professor", "Home Appliance Installer", "Home Appliance Repairer", "Home Economics Teacher", "Home Economist", "Home Entertainment System Installer", "Home Health Aide", "Home Health Technician", "Horticultural Worker Supervisor", "Horticulture Therapist", "Horticulturist (Vineyard)", "Hospital Administrator", "Hospital Nurse", "Hosts and Hostesses", "Hotel and Motel Desk Clerks", "Hotel Convention/Events Coordinator", "Hotel Manager", "Housekeeping Supervisors", "Human Factors Psychologist", "Human Resources Management Advisor", "Human Resources Management Consultant", "Hydraulic Engineer", "Immigration Inspector", "Industrial Air Pollution Analyst", "Industrial Arts Teacher", "Industrial Designer", "Industrial Engineer", "Industrial Engineering Technician", "Industrial Health Engineer", "Industrial Hygienist", "Industrial Machinery Mechanics", "Industrial Relations Analyst", "Industrial Relations Specialist", "Industrial Therapist", "Industrial Waste Inspector", "Industrial-Organizational Psychologist", "Infantry Officers", "Instructional Coordinators", "Instrument Technician", "Insulation Installer", "Insurance Adjuster", "Insurance Agent", "Insurance Appraiser (Auto Damage)", "Insurance Claim Examiner", "Insurance Claims Adjuster", "Insurance Claims Clerks", "Insurance Estate Planner", "Insurance Lawyer", "Insurance Policy Processing Clerk", "Insurance Underwriter", "Intelligence Specialist (Government)", "Interior Designer", "Internal Auditor", "Interpreter for the Hearing Impaired", "Irradiated-Fuel Handlers", "Irrigation Engineer", "IT Administrator (Information Technology)", "Janitorial Supervisors", "Job Analyst", "Job Development Specialist", "Job Printer (Graphic Arts)", "Kindergarten Teacher", "Labor Relations Advisor", "Laboratory Tester", "Land Surveyor", "Landscape Architect", "Landscape Contractor", "Lathe Operator", "Law Clerks", "Law Professor", "Legal Assistant", "Legal Secretary", "Legislative Assistant", "Library Assistant",
"Library Consultant", "Library Science Professor", "Library Technician", "License Clerk", "Licensed Practical Nurse (LPN)", "Livestock Commission Agent",
"Loan Counselor", "Loan Interviewers and Clerks", "Loan Officer", "Locomotive Engineers", "Log Graders and Scalers", "Logging Tractor Operator", "Logging Worker Supervisor", "Machine Feeders and Offbearers", "Mail Clerk", "Mail Machine Operators", "Maintenance Supervisor", "Makeup Artists - Theatrical", "Management Consultant (Analyst)", "Manicurists and Pedicurists", "Manual Arts Therapist", "Mapping Technician", "Marina Boat Charter Administrator", "Marine and Aquatic Biologist", "Marine Architect", "Marine Cargo Surveyor", "Marine Drafter", "Marine Engineer", "Marine Surveyor", "Marine/Port Engineer", "Market Research Analyst", "Marketing Managers", "Marking Clerk", "Marriage and Family Therapists", "Massage Therapist", "Materials Engineer", "Materials Inspector", "Materials Scientist", "Math Professor", "Mathematical Technician", "Meat Packers", "Mechanical Drafter", "Mechanical Engineer", "Mechanical Engineering Technician", "Mechanical Inspector", "Medical Administrative Assistant", "Medical and Public Health Social Workers", "Medical and Scientific Illustrator", "Medical Appliance Technician", "Medical Assistant", "Medical Equipment Preparer", "Medical Examiner/Coroner", "Medical Insurance Claims Analyst", "Medical Laboratory Technician", "Medical Photographer", "Medical Records Administrator", "Medical Records Technician", "Medical Secretary", "Medical Technologist", "Medical Transcriptionist", "Mental Health Counselor", "Mentally Retarded Students Teacher", "Merchandise Displayer", "Metal Casting Machine Operator", "Metal Fabricator", "Meter Mechanic", "Middle School Administrator", "Middle School Guidance Counselor", "Middle School Teacher", "Military Analyst", "Military Officer", "Military-Enlisted Personnel", "Mill Worker", "Mine Cutting Machine Operator", "Mine Inspector", "Mining Engineer", "Mining Machine Operator", "Mining Shovel Machine Operator", "Missing Person Investigator", "Missionary Worker (Foreign Country)", "Model Maker", "Motion Picture Director", "Motion Picture Projectionist", "Motor Vehicle Inspector", "Motorboat Mechanic", "Motorcycle Mechanic", "Municipal Fire Fighting Supervisor", "Museum Curator", "Museum Technicians and Conservators", "Music Arrangers and Orchestrators", "Music Director", "Music Teacher", "Music Therapist", "Musical Instrument Tuner", "Narcotics Investigator (Government)", "New Accounts Clerk (Banking)", "Newspaper Editor", "Newspaper/Magazines Writer", "Non-Retail Sales Supervisor", "Nuclear Engineer", "Nuclear Equipment Operation Technician", "Nuclear Fuels Research Engineer", "Nuclear Medicine Technologist", "Nuclear Monitoring Technician",
"Nuclear Power Reactor Operator", "Nuclear Technicians", "Numerical Tool Programmer", "Nurse Practitioner", "Nurse's Aide",
"Nursery Workers", "Nursing Professor", "Obstetrician (MD)", "Occupational Analyst", "Occupational Physician (MD)", "Occupational Safety & Health Inspector", "Occupational Therapist", "Occupational Therapy Assistant", "Oceanographic Assistant", "Office Clerk", "Office Machine Mechanic", "Office Supervisor", "Offset Press Operators", "Operating Engineers", "Operations Management Analyst", "Ophthalmic Laboratory Technician", "Ophthalmologist (MD)", "Oral and Maxillofacial Surgeons", "Order Clerk", "Ordinary Seamen", "Ornamental-Metalwork Designer", "Orthodontic Assistant", "Orthodontic Laboratory Technician", "Orthodontist (MD)", "Outdoor Education Teacher", "Overhead Door Installer", "Package Designer", "Packaging Machine Operator", "Painter (Industrial)", "Park Naturalist", "Parking Enforcement Officer", "Parking Lot Attendant", "Parole Officer", "Parts Salesperson", "Paste-Up Worker (Graphic Arts)", "Patent Agent", "Patent Lawyer", "Pathologist (MD)", "Payroll and Timekeeping Clerks", "PBX Installer and Repairer", "Peace Corps Worker (Volunteer)", "Pediatric Dentist", "Pediatrician (MD)", "Personal Service Supervisor", "Personnel Administrator", "Personnel Assistant", "Personnel Recruiter", "Pest Control Workers", "Pesticide Handlers", "Petroleum Engineer", "Petroleum Geologist", "Petroleum Laboratory Assistant", "Petroleum Refinery Operator", "Petroleum Technician", "Pharmacy Aides", "Pharmacy Technician", "Philosophy and Religion Professor", "Photo-Optics Technician", "Photoengravers (Graphic Arts)",
"Photogrammetric Engineer", "Photographic Equipment Mechanic", "Photographic Process Workers", "Physical Education Instructor", "Physical Therapist", "Physical Therapist Aides", "Physical Therapy Assistant", "Physician's Assistant (PA)", "Physician's Office Nurse", "Physics Professor", "Pilot (Commercial Airlines)", "Plant Breeder", "Plant Manager (Manufacturing)", "Plasterers and Stucco Masons", "Plastic Surgeon", "Platemakers (Graphic Arts)", "Plumber (Plumbing Contractor)", "Poets and Lyricists", "Police and Detectives Supervisor", "Police Artist", "Police Identification and Records Officers", "Police Officer", "Political Science Professor", "Political Scientist", "Postal Service Clerks", "Postal Service Mail Carriers", "Postal Service Mail Sorter", "Postmasters and Mail Superintendents", "Power Plant Operators", "Power-Line Installer and Mechanic", "Precision Devices Inspectors and Testers", "Preschool Administrator", "Preschool Teacher", "Pressing Machine Operator", "Pressure Vessel Inspectors", "Printing/Graphic Arts Reproduction Technician", "Printmaker (Artist)", "Private Detectives and Investigators", "Private Nurse", "Private Sector Executives", "Probate Lawyer", "Probation Officer", "Procurement Clerks", "Product Planner", "Product Safety Engineer", "Production Planner", "Professional Sports Scout", "Proofreaders and Copy Markers", "Property Accountant", "Property Assessor", "Property Managers", "Props and Lighting Technicians", "Prosthetic Technician", "Psychiatric Aide", "Psychiatric Technician", "Psychiatrist (MD)", "Psychology Professor", "Public Health Service Officer", "Public Relations Manager", "Public Relations Specialist", "Public Transportation Inspector", "Publications Editor", "Purchasing Agent", "Purchasing Manager", "Quality Control Coordinator", "Quality Control Engineer", "Quality Control Inspector", "Quality Control Technician", "Quarry Worker", "Radar and Sonar Technicians", "Radiation Protection Engineer", "Radiation Therapists", "Radio & TV Announcer", "Radio & TV News Commentator", "Radio & TV Newscaster", "Radio & TV Producer", "Radio & TV Program Director", "Radio & TV Sports Announcer", "Radio & TV Station Administrator", "Radio & TV Talk Show Host", "Radio Mechanics", "Radio Operators", "Radiologic Technicians", "Radiologic Technologist", "Radiologist (MD)", "Rail Yard Engineers", "Railroad Conductors and Yardmasters", "Railroad Engineer", "Railroad Inspector", "Range Manager", "Real Estate Appraiser", "Real Estate Assessor", "Real Estate Broker", "Real Estate Lawyer", "Real Estate Sales Agents", "Recreation Leader", "Recreational Protective Service Worker", "Recreational Therapist", "Recreational Vehicle Mechanic", "Referee / Umpire",
"Refuse and Recyclable Material Collectors", "Registrar Administrator", "Reliability Engineer", "Religious Institution Education Coordinator", "Reservation Ticket Agent", "Residence Counselor", "Resource Recovery Engineer", "Resource Teacher", "Respiratory Care Technician", "Respiratory Therapist", "Respiratory Therapy Technicians", "Restaurant Food Coordinator", "Restaurant Manager", "Retail Buyer", "Retail Customer Service Representative", "Retail Inventory Control Analyst", "Retail Sales Department Supervisor", "Retail Salespersons", "Retail Store Manager", "Revenue Agent (Government)", "Safety Inspector", "Sales Engineers", "Sales Floor Stock Clerk", "Sales Managers", "Sales Promoter", "Sales Representative (Aircraft)", "Sales Representative (Chemicals & Drugs)", "Sales Representative (Computers)", "Sales Representative (Graphic Arts)", "Sales Representative (Hotel Furnishings)", "Sales Representative (Medical Equipment)", "Sales Representative (Printed Advertising)", "Sales Representative (Radio & TV Time)", "Sales Representative (Telecommunications)", "Sales Representative (Teleconferencing)", "Sales Representative ( Education Programs)", "Sales Representatives (Agricultural Products)", "Sales Representatives (Instruments)", "Sales Representatives (Mechanical Equipment)", "Sales Representitive (Psychological Tests)", "Sanitary Engineer", "Sawing Machine Operator", "Scanner Operators", "School Nurse", "School Plant Consultant", "School Psychologist", "Scientific Linguist", "Scientific Photographer", "Screen Printing Machine Operators", "Screen Writer", "Script Editor", "Securities Broker",
"Security and Fire Alarm Systems Installers", "Security Guard", "Self-Enrichment Education Teachers", "Septic Tank and Sewer Servicers", "Service Station Attendants", "Set Designer", "Set Illustrator", "Sewing Machine Operators", "Sheet Metal Workers", "Ship Carpenters and Joiners", "Ship Engineers", "Ship Master", "Ship Mate", "Ship Pilot", "Shoe Machine Operators", "Signal Switch Repairers", "Skin Care Specialists", "Small Engine Mechanics", "Social and Community Service Managers", "Social and Human Service Assistants", "Social Psychologist", "Social Science Research Assistants", "Social Service Volunteer", "Social Welfare Administrator", "Social Work Professor", "Social Worker", "Sociology Professor", "Soil Conservation Technician", "Soil Conservationist", "Soil Engineer", "Soil Scientist", "Solar Energy Systems Designer", "Solid Waste Disposal Administrator", "Sound Engineering Technicians", "Special Education Administrator", "Special Forces", "Special Forces Officers", "Speech Pathologist", "Speech Writer", "Sport Psychologist", "Sport's/Entertainment Agent (Manager)", "Sports Agent", "Sports Events Business Manager", "Sports Physician (Orthopedist)", "Sportswriter (Journalist)", "Stained Glass Artist", "Standards Engineer", "Statement Clerks", "Stationary Engineers", "Statistical Assistants", "Steel Workers", "Storage and Distribution Manager", "Stress Analyst Engineer", "Structural Drafter", "Structural Engineer", "Student Admissions Administrator", "Student Affairs Administrator", "Student Financial Aid Administrator", "Substance Abuse Counselor", "Subway and Streetcar Conductor", "Surgeons (MD)", "Surgical Technician/Technologist", "Survey Researchers", "Surveying Technicians", "Switchboard Operator", "Systems Accountant", "Tax Accountant", "Tax Auditor", "Tax Collector", "Tax Examiner", "Tax Lawyer", "Tax Preparer", "Taxi Drivers and Chauffeurs", "Teacher of the Blind", "Teachers Aide", "Team Assemblers", "Technical & Scientific Publications Editor", "Technical Directors/Managers", "Technical Illustrator", "Technical Publications Writer", "Technological Espionage Intelligence Agent", "Telecommunications Line Installers and Repairers", "Telecommunications Maintenance Worker", "Telecommunications Technician", "Telephone Station Installers", "Textile Bleaching and Dyeing Machine Operators", "Textile Cutting Machine Operators", "Textile Designer", "Tile and Marble Setters", "Title Examiner", "Title Searchers", "Tool & Machine Designer", "Tool and Die Makers", "Tour Guide", "Town Clerk", "Traffic Administrator (Freight & Passenger)", "Traffic Agent", "Traffic Technicians", "Transit and Railroad Police",
"Transportation Attendants", "Transportation Systems Design Engineer", "Travel Agent", "Travel Clerks", "Travel Counselor", "Travel Writer (Journalist)", "Treasurer (Corporate)", "Treatment Plant Operators", "Tree Trimmers and Pruners", "Ultrasound Technologist", "Unemployment Inspector", "Urban and Regional Planner", "Ushers and Lobby Attendants", "Utility Meter Reader", "Vending Machine Mechanic", "Veterinarian (VMD)", "Veterinarian Technician", "Veterinary Assistant", "Video Engineer", "Vocational Education Instructors College", "Vocational Rehabilitation Counselor", "Voice Pathologist", "Waiters and Waitresses", "Warehouse Stock Clerk", "Watch Repairers", "Water Pollution Control Inspector", "Weather Observer", "Web Art Director", "Weighers and Measurers", "Welfare Eligibility Workers and Interviewers", "Wholesale Buyers", "Wildlife Biologist", "Wildlife Control Agent", "Windows - Draperies Treatment Specialist", "Woodworking Machine Operators", "Word Processing Specialist", "Writer /Author", "Zoo Veterinarian", "Zoologist")

symptoms = ("abdomen hurts", "back hurts", "chest hurts", "ear hurts", "head hurts", "pelvis hurts", "tooth hurts", "leg hurts",
"Chills", "Fever", "Paresthesia", "Light-headed", "Feel Dizzy", "dry mouth", "Nauseated", "Short of breath", "Sleepy", "Sweaty",
"Thirsty", "Tired", "Weak", "losing hearing", "sounds are too loud", "ringing or hissing in ears", "Blindness", "blurred vision", "double vision")

treatments = ("medicine", "physio therapy", "cut out the lot a tv", "refer to nutricianist")

addresses = ("Remington Avenue St. James", "Husband's Gardens St. James", "Garments Lane St. Michael",
"Jemmots Street St. Joseph", "Carrot Apple Lane Christ Church", "Pristine Gardens St. Phillip", "Diamond Rough Avenue St. Peter",
"Jackman's Alley St. Thomas", "Rocky Road Mountains St. Andrew", "Trippy Lane St. Lucy", "Gun Point Road St. Lucy",
"Yellowstone Street St. Phillip", "Harrison Cave Point St. Peter", "Johnson's Way Christ Church", "Blue Flower Street St. Andrew")


'''CREATE TABLE `Patient`
(
 `NationalID`         varchar(10) NOT NULL ,
 `sex`                enum('male','female') NOT NULL ,
 `FirstName`          varchar(25) NOT NULL ,
 `LastName`           varchar(25) NOT NULL ,
 `OtherNames`         varchar(50) NOT NULL ,
 `HospitalRegNo`      varchar(10) NOT NULL ,
 `DOB`                date NOT NULL ,
 `NextOfKin`          varchar(50) NOT NULL ,
 `Occupation`         varchar(50) NOT NULL ,
 `Address`            varchar(50) NOT NULL ,
 `Diagnosis`          varchar(40) NOT NULL ,
 `Temperature`        float NOT NULL ,
 `Pulse`              int NOT NULL ,
 `Respiration`        int NOT NULL ,
 `BloodPressure`      varchar(10) NOT NULL ,
 `SpO2`               varchar(10) NOT NULL ,
 `Investigations`     varchar(100) NOT NULL ,
 `TreatmentPlan`      varchar(120) NOT NULL ,
 `Symptoms`           varchar(75) NOT NULL ,
 `PresentingProblems` varchar(75) NOT NULL ,
);'''

def pad(v, n=2):
    if len(v) == n:
        return v
    else:
        for i in range(0, n):
            v = "0" + v
            if len(v) >= n:
                break
        return v


used_ids = []


def getId(y, m, d):
    found = False
    nid = 0
    while not found:
        id = pad(str(random.choice(range(0, 9999))), 4)
        nid = str(y)[2:] + pad(str(m)) + pad(str(d)) + str(id)
        if nid not in used_ids:
            found = True
    used_ids.append(nid)
    return id


def generateRecord():
    buffer = ""
    # if u want more than 10000 records, the id must be randomly generated and not derived from i
    for i in range(0, maxRecords):
        # select fields from data to make a record
        yr = random.choice(range(1945, 2019, 1))
        month = random.choice(range(1, 13, 1))
        day = random.choice(range(1, 29, 1))
        id = getId(yr, month, day)
        dob = str(yr) + '-' + pad(str(month)) + '-' + pad(str(day))
        nationalid = str(yr)[2:] + pad(str(month)) + pad(str(day)) + str(id)
        male = random.choice([True, False])
        fname = random.choice(male_f_names) if male else random.choice(female_f_names)
        lname = random.choice(lnames)
        oname = (random.choice(male_f_names) if male else random.choice(female_f_names)) + (" " + (random.choice(male_f_names) if male else random.choice(female_f_names)) if random.choice([True, False]) else "")
        hRegNo = str(random.choice(range(100, 999))) + pad(str(random.choice(range(100, 9999))), 4)
        kin = random.choice([random.choice(male_f_names), random.choice(male_f_names)]) + " " + random.choice(lnames)
        occupation = random.choice(occupations)
        temp = str(random.choice(range(365, 385, 1)) / float(10))[0:4]
        pulse = random.choice(range(40, 90, 1))
        respiration = random.choice(range(35, 50, 1))
        bloodpressure = str(random.choice(range(120, 180, 1))) + '/' + str(random.choice(range(120, 180, 1)))
        spo2 = random.choice(range(94, 100))
        symptom = '"' + random.choice(symptoms) + ((" " + random.choice(symptoms)) if random.choice([True, False]) else "") + '"'
        problem = '"' + random.choice(symptoms) + ((" " + random.choice(symptoms)) if random.choice([True, False]) else "") + '"'
        treatmentplan = random.choice(treatments)
        address = str(random.choice(range(1, 999))) + " " + random.choice(addresses)

        #build record
        record = str(nationalid) + ',' + ("male" if male else "female") + ',' + fname + ',' + lname + ',' + oname + ','
        record += str(hRegNo) + ',' + dob + ',' + kin + ',' + occupation + ',' + address + ',sick,' + temp + ','
        record += str(pulse) + ',' + str(respiration) + ',' + bloodpressure + ',' + str(spo2) + ',Intial Tests,'
        record += treatmentplan + ',' + symptom + ',' + problem

        buffer += record + "\n"

        if i % 1000 == 0:
            with open("db.csv", "a") as f:
                f.write(buffer)
            buffer = ""
            print("generated "+str(i)+" records")

    with open("db.csv", "a") as f:
        f.write(buffer)

def generateAssignedPersonnel():
    ids = []
    with open("db.csv", "r") as f:
        for i in range(0, 100):
            ids.append(f.readline().split(",")[0])
    with open("ids.txt", "w") as f:
        for i in range(0 ,100):
            f.write(ids[i] + "," + str(random.choice(range(1, 5))) + "\n")


generateAssignedPersonnel()
'''Marital_Status = ("single", "married", "separated", "diovorced", "widowed")

with open("db.part", "a") as f:
    f.write("INSERT INTO Patient (MaritalStatus, AdmissionDate) VALUES ")

buffer = ""
for i in range(0, maxRecords):
    status = "'" + random.choice(Marital_Status) + "'"
    yr = random.choice(range(1975, 2019, 1))
    month = random.choice(range(1, 13, 1))
    day = random.choice(range(1, 29, 1))
    time = pad(str(random.choice(range(0, 23, 1)))) + ":" + pad(str(random.choice(range(0, 59, 1)))) + ":" + pad(str(random.choice(range(0, 59, 1))))
    admission = "'" + str(yr) + '-' + pad(str(month)) + '-' + pad(str(day)) + " " + time + "'"
    buffer += "(" + status + ", " + admission +"), "
    if i % 1000 == 0:
        with open("db.part", "a") as f:
            f.write(buffer)
        buffer = ""
        print("Generated "+str(i))

with open("db.part", "a") as f:
    f.write(buffer)
'''