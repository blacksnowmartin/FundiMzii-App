from pathlib import Path
text = '''TECHNICAL UNIVERSITY OF KENYA
FACULTY OF APPLIED SCIENCES AND TECHNOLOGY
SCHOOL OF COMPUTING AND INFORMATION TECHNOLOGY
DEPARTMENT OF COMPUTER SCIENCE AND INFORMATICS

FUNDIMZII: A WEB-BASED APPLICATION FOR RECORDING AND TRACING CLIENT MEASUREMENTS FOR TAILORS

PRESENTED BY:
MARTIN Mwendwa KITONGA
REG NO: SCNI/01292/2021
SUPERVISED BY: MADAM ELIZABETH MULI AND MR. PETER MULEI

A PROJECT PROPOSAL SUBMITTED TO THE SCHOOL OF COMPUTING AND INFORMATION TECHNOLOGY IN PARTIAL FULFILLMENT OF THE REQUIREMENTS FOR THE AWARD OF THE BACHELOR OF TECHNOLOGY IN COMMUNICATION AND COMPUTER NETWORKS OF THE TECHNICAL UNIVERSITY OF KENYA

SUBMISSION DATE: 22 JANUARY 2026

DECLARATION
I, Martin Mwendwa Kitonga, declare that this project proposal is my original work and has not been submitted to any other institution for examination or award. All sources of information used have been duly acknowledged and referenced in accordance with the Technical University of Kenya requirements.

DEDICATION
This proposal is dedicated to my family for their encouragement, support, and motivation throughout my academic journey.

ACKNOWLEDGEMENT
I sincerely thank my supervisors, Madam Elizabeth Muli and Mr. Peter Mulei, for their guidance and valuable advice throughout the preparation of this proposal. I also appreciate the tailors at Kariobangi North Market for sharing their experiences, which informed this study. Special thanks go to my family and friends for their constant support.

LIST OF ABBREVIATIONS
ICT - Information and Communication Technology
UI - User Interface
DFD - Data Flow Diagram
UML - Unified Modeling Language
API - Application Programming Interface
PDF - Portable Document Format
XAMPP - Cross-Platform Apache, MySQL, PHP, and Perl

ABSTRACT
This proposal presents the development of FundiMzii, a web-based application designed to help tailors record and trace client measurements efficiently. The tailoring sector in Kenya still relies heavily on manual record keeping, which often leads to lost records, illegible entries, delayed retrieval of client information, and reduced service quality. The proposed system will provide a simple and affordable platform for capturing client details, storing measurements, searching records, attaching photos, and generating reports. The project will be developed using HTML5, CSS3, Bootstrap, JavaScript, PHP, and MySQL, with XAMPP used as the local development environment. The study will adopt an agile approach and will gather requirements through interviews, observation, and document review. The proposal outlines the background, literature review, methodology, system analysis, and design considerations that will guide the development of the prototype.

TABLE OF CONTENTS
Chapter One: Introduction
Chapter Two: Literature Review
Chapter Three: Methodology
Chapter Four: System Analysis and Requirement Modeling
Chapter Five: System Design
Chapter Six: System Implementation
Chapter Seven: User Manual and Documentation
Chapter Eight: Limitations, Challenges, Conclusions, and Recommendations
References
Appendices

CHAPTER ONE
INTRODUCTION

1.1 Introduction
The tailoring industry depends on accurate client measurement records to support garment production, fittings, alterations, and repeat orders. In many informal tailoring businesses, these records are still kept manually in notebooks, which creates risks of loss, damage, duplication, and retrieval difficulties. This project proposes a web-based solution that will improve the way tailors manage client measurements and order history.

1.2 Background of the Study
FundiMzii is intended for small-scale tailors operating in informal business settings, especially those who serve walk-in customers and repeat clients. Most of these businesses rely on handwritten notes to record measurements and customer preferences. Although this approach is inexpensive, it is slow, prone to error, and difficult to search when a client returns after a long period. The proposed system will digitize this process and make record keeping more reliable.

1.2.1 Background of the Organization
This proposal is based on the tailoring businesses located at Kariobangi North Market, Nairobi County. The market hosts many informal tailors who provide custom clothing services to local residents. These businesses have grown over time due to demand for affordable and personalized clothing services. However, their growth has not been matched by equally efficient record-management systems.

1.2.2 Overview of the Existing System
Currently, most tailors record client measurements manually using exercise books and loose papers. When a customer visits, the tailor writes down the client’s name, contact details, and measurements, then stores the information in a notebook. Retrieving old records requires searching page by page. This system is vulnerable to loss, damage, misplacement, illegibility, and duplication of information. It also consumes time, especially when a returning customer needs old measurements quickly.

1.2.3 Overview of the Proposed System
The proposed FundiMzii system will allow tailors to register clients, record measurements digitally, search records quickly, attach photos, and generate printable reports. The system will use a web-based interface that can be accessed from a computer or smartphone. It will be designed for ease of use and will reduce the time spent on record retrieval and correction of errors.

1.3 Problem Statement
Small-scale tailors in informal business settings continue to rely on manual record-keeping methods that are inefficient and unreliable. As a result, client measurements are often misplaced, difficult to retrieve, or recorded inaccurately. These weaknesses reduce service quality, delay order processing, and make it difficult for tailors to maintain customer satisfaction and business continuity. There is therefore a need for a simple, affordable, and digital system that will improve measurement storage and retrieval.

1.4 Objectives

1.4.1 Project Goal
The overall goal of this project is to develop a web-based application that will enable tailors to record and trace client measurements efficiently.

1.4.2 General Objectives
The general objective is to design and develop a user-friendly system that will improve measurement management for tailors in informal business settings.

1.4.3 Specific Objectives
- To investigate the current measurement-recording practices used by tailors.
- To design a digital system for recording client measurements and order details.
- To develop a web-based application for storing, retrieving, and managing measurements.
- To test the system to ensure it is functional, usable, and reliable.
- To document the implementation process and prepare a working prototype.

1.5 Justification
This project is justified by the need to improve record management in the tailoring sector, where most businesses still depend on manual notebooks. A digital system will help reduce record loss, improve accuracy, save time, and support better customer service. The project is timely because many small businesses are gradually adopting digital tools, yet most informal tailors still lack a system suited to their work environment. The proposed solution will benefit tailors by improving efficiency and helping them serve clients more professionally.

1.6 Scope of the Study
The study will focus on developing a web-based system for recording and tracing client measurements for small-scale tailors. The system will cover client registration, measurement entry, search, update, deletion, and report generation. It will not include full e-commerce functionality, payment processing, or inventory management. The scope is limited to the record-management needs of tailoring businesses in informal settings.

1.7 Limitations of the Proposed System
The proposed system may face limitations such as limited internet access for some users, lack of suitable devices, time constraints during development, and limited user familiarity with digital systems. The prototype will also be limited to the core measurement-recording functions and may not include advanced features such as payment integration or mobile app deployment.

1.8 Project Risks and Mitigation
- Technical challenges in development: These will be managed through testing, debugging, and use of reliable development tools.
- User resistance to change: This will be addressed through user training and involvement during testing.
- Time limitations: The project schedule will be followed strictly, with milestones monitored regularly.
- Data loss or corruption: Backup procedures and proper database management will be used.
- Limited resources: Open-source software and available laboratory equipment will be used.

1.9 Project Schedule
The project will be carried out in phases, beginning with topic selection and problem identification, followed by requirements gathering, literature review, system analysis, design, implementation, testing, and report writing. A Gantt chart and network diagram will be prepared and included in the appendix to show the project timeline and critical path.

1.10 Budget and Resources
The project will require a computer, internet access, printing materials, transport for data collection, and software development tools. The expected budget will mainly cover transport, printing, stationery, and incidental development costs. Open-source tools such as XAMPP, PHP, MySQL, and web browsers will be used to minimize costs.

CHAPTER TWO
LITERATURE REVIEW

2.1 Reviewed Similar Systems
Several digital record-keeping systems have been developed for small businesses and service providers. These systems demonstrate that digital tools can improve storage, retrieval, and management of client records. However, many of them are not tailored to the specific needs of informal tailors in Kenya.

2.2 Tools and Methodologies Used in Reviewed Systems
Previous systems have used technologies such as mobile applications, database-driven web systems, and cloud-based platforms. Some studies have adopted agile development, while others have used waterfall or prototyping approaches. Although these methods are effective in different contexts, many solutions remain either too costly, too complex, or too dependent on stable internet connections.

2.3 Gaps in the Existing Systems and the Proposed Solution
The reviewed systems often lack simplicity, local relevance, offline friendliness, and affordability. Some are designed for large businesses rather than small informal enterprises. Others do not support the type of record structure used by tailors. FundiMzii will bridge this gap by offering a lightweight, easy-to-use, and context-specific web application for measurement management.

2.4 The Proposed Solution
The proposed system will provide a simple digital platform that tailors can use to record, search, and update client measurements. It will improve access to records, reduce errors, and support faster service delivery. The system will be designed with local users in mind, making it more practical for informal tailoring businesses.

CHAPTER THREE
METHODOLOGY

3.1 Methodology and Tools
This project will adopt the agile methodology because it allows iterative development, continuous feedback, and flexibility in responding to user requirements. The system will be modeled using tools such as flowcharts, data flow diagrams, use case diagrams, and entity relationship diagrams. The development tools will include HTML5, CSS3, Bootstrap, JavaScript, PHP, MySQL, and XAMPP.

3.2 Source of Data
The study will use both primary and secondary sources of data. Primary data will be collected directly from tailors through interviews, observation, and questionnaires. Secondary data will be obtained from books, journal articles, online resources, and academic reports.

3.3 Data Collection Methods
Data will be collected using interviews to gather detailed user requirements, questionnaires to obtain structured responses, observation to understand daily work processes, and document inspection to review existing record-keeping practices. These methods will help identify the challenges faced by tailors and the features required in the proposed system.

3.4 Resources Required
The project will require a desktop or laptop computer, internet access, a web server environment, and database software. The minimum hardware specifications will include at least 4GB RAM, a processor of 2.0 GHz or higher, and sufficient disk space for application files and database storage. The software requirements will include an operating system, XAMPP, a code editor, a browser, and antivirus software.

CHAPTER FOUR
SYSTEM ANALYSIS AND REQUIREMENT MODELING

4.1 Introduction to System Analysis
System analysis will be carried out to understand the current manual record-keeping process and determine the requirements of the proposed system. This stage will help identify functional and non-functional requirements before development begins.

4.2 Objectives of the System Analysis
The main objective of system analysis is to examine the existing record-keeping process, identify its weaknesses, and determine how the proposed solution will improve efficiency, accuracy, and accessibility.

4.3 Problem Definition
The existing manual system used by tailors makes it difficult to store and retrieve client measurements efficiently. This leads to delays, record loss, and service inefficiencies. The proposed system is intended to solve these problems through digital storage and quick search capabilities.

4.4 Feasibility Study
Technical feasibility will be achieved through the use of readily available web technologies and open-source software. Operational feasibility is supported by the fact that the system will be simple and suitable for tailors with basic digital skills. Economic feasibility is assured because the project will rely on low-cost tools and minimal infrastructure. Schedule feasibility is achievable because the system will be developed within the academic timeline.

4.5 System Analysis Tools
The system will be analyzed using context diagrams, data flow diagrams, use case diagrams, and flowcharts. These tools will help illustrate how data moves through the current and proposed systems and how the users will interact with the application.

4.6 System Investigation

4.6.1 Introduction
System investigation will be undertaken to gather detailed information about how tailors currently manage client measurements and what challenges they face.

4.6.2 Data Collection
Data will be collected through interviews, questionnaires, observation, and document review. The information gathered will be used to shape the requirements and design of the proposed system.

4.6.3 Fact Recording
The facts gathered will be recorded using narratives, forms, and diagrams. These records will describe input requirements, output requirements, process requirements, file requirements, system requirements, and personnel requirements.

4.7 System Analysis
The current system will be analyzed to determine how the proposed system should be structured. The analysis will cover user needs, data flow, storage requirements, and processing needs. The results will guide the design of the web-based application.

CHAPTER FIVE
SYSTEM DESIGN

5.1 Introduction to System Design and Nature of the System
System design will translate the requirements identified in the analysis phase into a structured solution. The proposed system will be designed as a web-based application with a database-driven architecture.

5.2 Objectives of System Design
The objectives of system design are to create a clear structure for the application, define database relationships, plan user interfaces, and ensure that the final system is easy to use and maintain.

5.3 Program Design Tools
The system will be designed using entity relationship diagrams, data dictionaries, algorithms, flowcharts, and module diagrams. These tools will guide database structure, interface design, and program logic.

5.4 Logical Design

5.4.1 Logical Data Design
The logical data design will define the relationships among key entities such as clients, measurements, orders, and users. Normalization will be applied to remove redundancy and improve database efficiency.

5.4.2 Entity Attributes Relationships
Each entity will be assigned relevant attributes. For example, the client entity will include client ID, name, phone number, and address, while the measurements entity will store measurements linked to the client record.

5.4.3 Entity Life History
The entity life history will describe how records are created, updated, retrieved, and deleted within the system lifecycle.

5.5 Physical Design Description

5.5.1 Data Dictionary
The data dictionary will define all fields, data types, sizes, and constraints used in the database.

5.5.2 File/Database Design
The database will contain tables for clients, measurements, users, and reports. Each table will be designed to support efficient storage and retrieval.

5.5.3 Input Screen Design
Input screens will be created for client registration, measurement entry, and record updates. The screens will be simple, clear, and suitable for non-technical users.

5.5.4 Output Screen Design
Output screens will present search results, client details, measurement history, and printable reports.

5.5.5 Code Design
Record keys and identifiers will be designed to ensure each record is unique and easily traceable.

5.5.6 Block Diagram and Modular Chart
The system will be divided into modules such as authentication, client management, measurement entry, record search, reporting, and database administration.

5.5.7 Process / Program Design / UML
The system flowchart, program flowchart, and modular flowcharts will be prepared to show the logic of the complete application and its individual modules.

CHAPTER SIX
SYSTEM IMPLEMENTATION

6.1 Coding, Environment, Debugging, and Techniques
The system will be implemented using HTML5, CSS3, Bootstrap, JavaScript, PHP, and MySQL. Development will be carried out in a local XAMPP environment. Debugging will be done through testing, error checking, and code correction during implementation.

6.2 Program Listing
A sample of the source code will be included in the appendix. The code will contain comments to improve readability and maintainability.

6.3 Test System and Program Testing
The program will be tested to confirm that all functions work as expected. Testing will include input validation, database storage, search functions, and report generation.

6.4 Test Plan
The test plan will verify all form fields, database operations, and user actions. Each module will be checked for correctness, reliability, and ease of use.

6.5 Test Data
Test data will include sample client records, measurement values, and search queries used to evaluate system behaviour.

6.6 Sample Run and Output Result
Sample outputs such as client lists, measurement reports, and search results will be captured and included in the appendix.

CHAPTER SEVEN
USER MANUAL AND DOCUMENTATION

7.1 Installation Environment
The system will run on a computer or laptop with a web browser, XAMPP, and a supported operating system.

7.2 Installation Requirements
The user will require a computer, browser, database server, and application files to install the system locally or on a web server.

7.3 Installation Procedures
Installation will involve setting up the server environment, importing the database, configuring the application, and launching the system through a browser.

7.4 User Instructions
Users will be guided on how to log in, add new clients, enter measurements, search records, update details, and generate reports. Screenshots of the system interface will be included in the final documentation.

7.5 System Conversion Methods
The system will be introduced using direct conversion or parallel use depending on the user environment and training readiness.

7.6 User Training
Training will be provided through demonstrations, guided practice, and simple user manuals to help users understand the system.

7.7 File Conversions
Existing manual records may be transferred into digital form where necessary to support system adoption.

CHAPTER EIGHT
LIMITATIONS, CHALLENGES, CONCLUSIONS, AND RECOMMENDATIONS

8.1 Limitations
The project may be affected by limited time, limited financial resources, incomplete user data, and possible difficulty in accessing some users during data collection.

8.2 Challenges
Challenges may include user resistance to change, technical errors during development, and delays in gathering feedback.

8.3 Degree of Success
The project is expected to achieve its main objective of developing a working prototype that supports client measurement recording and tracing.

8.4 Learning Experience
The project will provide valuable learning experience in requirements gathering, system analysis, database design, programming, testing, and academic report writing.

8.5 Conclusion
The proposed FundiMzii system offers a practical solution to the record-management problems experienced by informal tailors. By replacing manual notebooks with a digital application, the system will improve efficiency, accuracy, and accessibility of client information. The project will also demonstrate how technology can support small business operations in the tailoring sector.

REFERENCES
Akinyi, L., et al. (2026). Digital inclusion in Kenya's fashion industry. Proceedings of the IEEE Africa Conference, 200-215.

Kenya Vision 2030. (2008). Government of Kenya.

Mwangi, J., et al. (2023). Mobile apps for small enterprises in Kenya. Journal of African Business Technology, 15(2), 45-60.

Njoroge, P. (2025). IoT in East African tailoring systems. African Journal of Computing, 8(3), 78-92.

Ochieng, A., & Kimani, S. (2024). User-centered design in African informal sectors. International Journal of ICT for Development, 12(1), 112-130.

APPENDICES
Appendix I: Gantt chart
Appendix II: Network diagram
Appendix III: Sample questionnaires and interview guide
Appendix IV: Sample system code
Appendix V: Sample screenshots
'''
Path('output').mkdir(exist_ok=True)
Path('output/PROJECT-A_REWRITTEN.txt').write_text(text, encoding='utf-8')
print('saved')