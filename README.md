![e-Yantra Summer Internship](http://www.e-yantra.org/img/EyantraLogoLarge.png)
***
# eYSIP-2016-Web-Monitoring-For-Greenhouse
Through this project we will design a web portal which will be used for control/monitor the various aspects of the greenhouse mainly scheduling/manual switching of irrigation valves, visualization of the data collected from the sensors nodes, managing the devices and displaying their status.

Website will be designed using the following Web development technologies:
* **Front-end+Back-end:** AngularJS, PHP, Bootstrap, Javascript (including JQuery and AJAX and NodeJS)
* **Database:** MySQL
* **Communication Protocol:** WebSocket
* **Web Tools:** Sublime Text, Bower
* **Development platform:** Linux Ubuntu
* **Target Environment:** Desktop, Tablet and Mobile


##Description:
***
Greenhouse has columns of troughs containing plants. Current hardware setup at the Greenhouse has Two types of devices, one controls the irrigation valves and the other gets the temperature, humidity, moisture values. The first type controls 1-10 Irrigation valves at a time. The second type of device also known as Sensor nodes gathers the environment values. Irrigation valves and the sensor nodes are placed at every troughs and are placed in different groups.

##Features:
***
- **Registration and Authentication:** Website should support two user roles, Admin and Normal user. Website should restrict access to only users those are registered with the website and provide registration for new users to be approved by the admin user.
- **Devices’ Management:** User should be able to create and manage different groups, add Irrigation valves and the sensor nodes to different groups. View newly discovered devices and take actions on them.
- **Show controls for switching the Irrigation valves:** User should able to select the group and switch the concerned Irrigation valves of that group. Simple ON/OFF buttons with duration option to switch the valves.
- **Scheduling the Irrigation Valves:** Website should add support for different type of scheduling, such as **Time period**, **Duration** and **Frequency** per day etc. Scheduling to be done on the basis of the groups. User should be able to view/manage the scheduled groups and check their running status.
- **Devices’ Status:** Page for showing devices’ status data for monitoring purpose, mainly battery value, ONLINE/OFFLINE timings, device informations including group name, device Id etc, and their current state.
	(Use of Charts is needed here especially Gantt and Line Chart)
- **Data Visualisation:** Several types of data such as temperature, humidity, battery voltage, moisture etc to be plotted in real time and analysed.
	(Use of Chart is needed, Line Chart)
- **Video Visualisation:** Support for showing Live Feed from the CCTV set at the Greenhouse.
- **Admin page:** Page for approving/deleting the users.
- **Dashboard:** Website should have a Homepage/Dashboard showing the summarized data of most of the above features.

**Note:**

1. Normal User should only be able to view Scheduling Page, Valve Control page, Device Status and Data Visualization Page.
2. Admin should be able to view all pages and approve new Users.
3. Bootstrap themes can be used for faster prototyping.
4. Source code should be documented with comments.
5. Daily Update of the Progress on the Github wiki.

##Documentation
***
> To be updated

##Folder Tree
***
> To be updated

##Contributors
***
  * [Ankit Gala](https://github.com/Ankitgl444)
  * [Neel M Rami](https://github.com/thephenominal)
  
## Mentors
***
  * [Jayant Solanki](https://github.com/jayantsolanki)

##License
***
This project is open-sourced under [MIT License](http://opensource.org/licenses/MIT)
