<?php
session_start();
require_once('../php/db_conn.php');
// Function to update the most visited and least visited tabs in $_SESSION['tabs']
function updateTabCounts($tabName) {
    // Update the corresponding tab count in $_SESSION['tabs']
    if (isset($_SESSION['tabs'][$tabName])) {
        $_SESSION['tabs'][$tabName]++;
    } else {
        $_SESSION['tabs'][$tabName] = 1;
    }
}

// Check if tabName parameter is passed (when a tab is clicked)
if (isset($_GET['tabName'])) {
    $tabName = $_GET['tabName'];
    updateTabCounts($tabName);
}

// Handle database update logic when the user leaves the page (beforeunload event)
if (isset($_SESSION['tabs'])) {
    // Your database connection code here
   
    if (!$conn) {
        die("Database connection failed: " . mysqli_connect_error());
    }

    if ($conn) {
        // Perform the database update with $_SESSION['tabs']
        $fname = $_SESSION['fn']; // Replace 'fn' with your actual session variable name for fname
        $mostVisited = array_search(max($_SESSION['tabs']), $_SESSION['tabs']);
        $leastVisited = array_search(min($_SESSION['tabs']), $_SESSION['tabs']);
        $mostVisitNumber = max($_SESSION['tabs']);
        $leastVisitNumber = min($_SESSION['tabs']);

        // Replace 'course_data' with your actual table name
        $sql = "INSERT INTO course_data (fname, most_visited_tab, least_visited_tab, most_visit_number, least_visit_number, allpagevisited)
                VALUES (?, ?, ?, ?, ?, ?)
                ON DUPLICATE KEY UPDATE
                most_visited_tab = ?, least_visited_tab = ?, most_visit_number = ?, least_visit_number = ?";

        $stmt = $conn->prepare($sql);
        $stmt->bind_param("sssiisssii", $fname, $mostVisited, $leastVisited, $mostVisitNumber, $leastVisitNumber, $allPageVisited, $mostVisited, $leastVisited, $mostVisitNumber, $leastVisitNumber);
        $allPageVisited = (count($_SESSION['tabs']) === 17) ? 1 : 0;
        $stmt->execute();
        $stmt->close();

        // Close the database connection
        mysqli_close($conn);
    }
}

// End PHP code
?>



<!DOCTYPE html>
<html>
<head>
  <title>Technology</title>
  <link rel="icon" href="../assets/products/Technology/technology.png">
  <link rel="stylesheet" href="../css/learning.css">
</head>
<body>
  <div>
    <table class="table1">
      <tr>
          <td class="td1">
             <a href="../php/homepage.php"> <img src="../assets/icons/art.png" alt="icon">
          </td>
          <td class="td1">
              <h1 class="hea">ASTAVERSE </h1>
          </td>
          <td class="td1">
            <img onclick="logout()" src="../assets/icons/logout.png" class="ico" alt="logout">
          </td>
          <td class="td1">
            <a href="../php/settings.php"><img src="../assets/icons/settings.png" class="ico" alt="settings"></a>
          </td>
      </tr>    
    </table>
  </div>
  <div class="tab">
    <button class="tablinks" onclick="openTab(event, 'tab0')"><h3>Computer and Its Type</h3></button>
    <button class="tablinks" onclick="openTab(event, 'tab1')"><h3>Generation of Computer</h3></button>
    <button class="tablinks" onclick="openTab(event, 'tab2')"><h3>Types of Computers</h3></button>
    <button class="tablinks" onclick="openTab(event, 'tab3')"><h3>Hardware and Software</h3></button>
    <button class="tablinks" onclick="openTab(event, 'tab4')"><h3>Input Devices</h3></button>
    <button class="tablinks" onclick="openTab(event, 'tab5')"><h3>Output Devices</h3></button>
    <button class="tablinks" onclick="openTab(event, 'tab6')"><h3>CPU</h3></button>
    <button class="tablinks" onclick="openTab(event, 'tab7')"><h3>RAM</h3></button>
    <button class="tablinks" onclick="openTab(event, 'tab8')"><h3>Storage Devices</h3></button>
    <button class="tablinks" onclick="openTab(event, 'tab9')"><h3>Types of Network</h3></button>
    <button class="tablinks" onclick="openTab(event, 'tab10')"><h3>Internet</h3></button>
    <button class="tablinks" onclick="openTab(event, 'tab11')"><h3>Software</h3></button>
    <button class="tablinks" onclick="openTab(event, 'tab12')"><h3>System Software</h3></button>
    <button class="tablinks" onclick="openTab(event, 'tab13')"><h3>Application Software</h3></button>
    <button class="tablinks" onclick="openTab(event, 'tab14')"><h3>Utility Software</h3></button>
    <button class="tablinks" onclick="openTab(event, 'tab15')"><h3>Operating System</h3></button>
    <button class="tablinks" onclick="openTab(event, 'tab16')"><h3>Virus and Malwares</h3></button>
  
  </div>

    <div id="tab0" class="tabcontent">
      <h1 class="hi">Computer and Its Types</h1>
      <br>
      <h2 class="topics" align="left">What is a computer ?</h2>
      <p class="text_content">
        A computer is an electronic device that can perform a wide range of tasks by executing sequences of instructions known as programs. 
        These instructions are processed through a central processing unit (CPU) that performs arithmetic and logical operations, 
        as well as manages data input/output and memory functions.
      </p><br>

      <div class="gif-container">
        <img src="../assets/products/Technology/computer.gif" alt="computer" class="imga">
      </div>
      

      <h2 class="topics" align="left">Why we need a computer ?</h2>
      <p class="text_content">
        Computers come in various forms and sizes, from personal computers (PCs) and laptops to smartphones, tablets, servers, and supercomputers. 
        They have become an integral part of modern life and are used for a multitude of purposes, including:
      </p><br>
      <ul>
        <li class="modern-list"><b>Data processing: </b> Computers can perform complex calculations and process large amounts of data quickly and accurately. </li>
        <div class="gif-container">
          <img src="../assets/products/Technology/stats.gif" alt="stats" class="imga">
        </div>
        <li class="modern-list"><b>Communication: </b> They enable communication through email, social media, video conferencing, and other online platforms.</li>
          <img src="../assets/products/Technology/communication.gif" alt="comms" class="imga">
        
        <li class="modern-list"><b>Information storage and retrieval:</b>Computers can store vast amounts of data, making it easily accessible when needed.</li>
          <img src="../assets/products/Technology/data_transfer.gif" alt="dt" class="imga">
        
        <li class="modern-list"><b>Entertainment:</b>Computers are used for gaming, watching videos, listening to music, and other recreational activities.</li>
          <img src="../assets/products/Technology/streaming.gif" alt="entertainment" class="imga">
        
        <li class="modern-list"><b>Automation:</b>They are utilized in various industries for automation and control of processes, such as manufacturing and robotics.</li>
          <img src="../assets/products/Technology/robot.gif" alt="robot" class="imga">
        
        <li class="modern-list"><b>Internet and networking:</b>Computers facilitate internet browsing and enable networking between devices.</li>
          <img src="../assets/products/Technology/internet.gif" alt="internet" class="imga">
        
        <li class="modern-list"><b>Scientific research and simulations:</b>High-performance computers are used in scientific research and simulations for various fields like physics, 
          chemistry, weather forecasting, and more.</li>
          <img src="../assets/products/Technology/scientific.gif" alt="scientific" class="imga">
        
      </ul>

    </div>

    <div id="tab1" class="tabcontent">
      <h1 class="hi">Generation of Computers </h1>
      <br>
      <h2 class="topics">First Generation (1940s-1950s):</h2><br>
      <table>
        <tr>
          <td>
            <img src="../assets/products/Technology/first_gen.jpeg" class="img_content">
            <br>
            <label class="label_content"> First Generation Computer </label>
          </td>
          <td>
            <img src="../assets/products/Technology/first_gen_vt.jpg" class="img_content">
            <br>
            <label class="label_content"> Vaccumm Tubes </label>
          </td>

        </tr>
      </table>
      <p class="text_content">
        The first generation of computers emerged during the 1940s and 1950s. 
        They were huge machines that filled entire rooms and used vacuum tubes for processing data. 
        Think of vacuum tubes as old-fashioned light bulbs, but much larger and used for computing. 
        These computers were slow and not very reliable compared to today's standards, 
        but they laid the groundwork for future innovations.
      </p>
      <h2 class="topics">Second Generation (1950s-1960s):</h2><br>
      <table>
        <tr>
          <td>
            <img src="../assets/products/Technology/second_gen.jpeg" class="img_content">
            <br>
            <label class="label_content"> Second Generation Computer </label>
          </td>
          <td>
            <img src="../assets/products/Technology/second_gen_tr.jpeg" class="img_content">
            <br>
            <label class="label_content"> Transistors </label>
          </td>

        </tr>
      </table>
      <p class="text_content">
        The second generation of computers came about in the 1950s and 1960s. 
        Instead of vacuum tubes, these computers used transistors. 
        Transistors were smaller, faster, and more reliable than vacuum tubes. 
        As a result, computers became more powerful, smaller in size, and 
        required less maintenance. 
        This generation also saw the introduction of programming languages like FORTRAN and COBOL.
      </p>

      <h2 class="topics">Third Generation (1960s-1970s):</h2><br>
      <table>
        <tr>
          <td>
            <img src="../assets/products/Technology/third_gen.jpeg" class="img_content">
            <br>
            <label class="label_content"> Third Generation Computer </label>
          </td>
          <td>
            <img src="../assets/products/Technology/third_gen_ic.jpeg" class="img_content">
            <br>
            <label class="label_content"> Integrated Circuits </label>
          </td>

        </tr>
      </table>
      <p class="text_content">
        The third generation of computers emerged in the 1960s and lasted through the 1970s. 
        During this time, computers started using integrated circuits (ICs). 
        ICs are tiny silicon chips that contain many transistors and other components. 
        This development significantly increased computing power, 
        reduced the size of computers even further, and made them more energy-efficient.
      </p>

      <h2 class="topics">Fourth Generation (1970s-1980s):</h2><br>
      <table>
        <tr>
          <td>
            <img src="../assets/products/Technology/fourth_gen.jpeg" class="img_content">
            <br>
            <label class="label_content"> Fourth Generation Computer </label>
          </td>
          <td>
            <img src="../assets/products/Technology/fourth_gen_mp.jpg" class="img_content">
            <br>
            <label class="label_content"> Microprocessors </label>
          </td>

        </tr>
      </table>
      <p class="text_content">
        The fourth generation of computers began in the 1970s and continued into the 1980s. 
        Microprocessors, which are complete central processing units (CPUs) on a single chip, 
        were the defining feature of this era. 
        
        Microprocessors made computers even more compact, affordable, and accessible to the general public. 
        It was during this time that personal computers (PCs) started becoming popular.  
      </p>

      <h2 class="topics">Fifth Generation (1980s-Present):</h2><br>
      <table>
        <tr>
          <td>
            <img src="../assets/products/Technology/fifth_gen.jpeg" class="img_content">
            <br>
            <label class="label_content"> Personal Computer </label>
          </td>
          <td>
            <img src="../assets/products/Technology/fifth_gen_lap.jpeg" class="img_content">
            <br>
            <label class="label_content"> Laptops </label>
          </td>

        </tr>
      </table>
      <p class="text_content">
        The fifth generation of computers started in the 1980s and is ongoing today. 
        During this era, computers have become smarter and more advanced. 
        Researchers have been working on artificial intelligence (AI) to make computers capable of learning, 
        reasoning, and solving complex problems.<br> 
        This has led to developments in areas like natural language processing, 
        computer vision, and robotics.  
      </p>




    </div>

    <div id="tab2" class="tabcontent">
      <h1 class="hi">Types of Computers</h1>
      <br>
      <p class="text_content">
        Computers come in various types, each designed for specific purposes and use cases. 
        Here are some common types of computers:
      </p>
      <ul>
        <li class="modern-list">
            <b>Personal Computer :</b><br>
            <table>
              <tr>
                <td>
                  <img src="../assets/products/Technology/types_of_computer/pc.jpeg" class="img_content">
                  <br>
                  <label class="label_content"> Personal Computer </label>
                </td>
                <td>
                  <img src="../assets/products/Technology/types_of_computer/laptop.jpeg" class="img_content">
                  <br>
                  <label class="label_content"> Laptop </label>
                </td>
        
              </tr>
            </table>
            <p class="text_content">
                Personal computers, commonly known as PCs, are versatile machines designed for individual use. 
                They come in desktop and laptop forms. PCs are used for a wide range of tasks, such as word processing, 
                web browsing, gaming, multimedia, and general computing.
            </p>
            <p class="text_content">
                Laptops and notebooks are portable versions of personal computers. 
                They offer similar functionalities to desktop PCs but are designed for on-the-go use. 
                Laptops are compact, lightweight, and battery-powered, 
                making them ideal for travel and mobile computing.
            </p>
        </li>
        
        <li class="modern-list">
            <b>Tablets and Smartphone :</b><br>
            <table>
              <tr>
                <td>
                  <img src="../assets/products/Technology/types_of_computer/tablet.jpeg" class="img_content">
                  <br>
                  <label class="label_content"> Tablet </label>
                </td>
                <td>
                  <img src="../assets/products/Technology/types_of_computer/smartp.jpeg" class="img_content">
                  <br>
                  <label class="label_content"> Smartphones </label>
                </td>
        
              </tr>
            </table><br>
            <p class="text_content">
                Tablets are a type of portable computer with a touchscreen interface. 
                They are more compact and lighter than laptops and often used for browsing the internet, 
                reading e-books, watching videos, and playing casual games.
            </p>
            <p class="text_content">
                Smartphones are handheld devices that combine the features of a mobile phone and a computer.
                They are extremely versatile, providing access to apps, internet browsing, email,
                multimedia, and more. Smartphones have become an essential part of modern life.
            </p>    
        </li>
        <li class="modern-list">
            <b>Workstations :</b><br>
            <table>
              <tr>
                <td>
                  <img src="../assets/products/Technology/types_of_computer/workstation.jpg" class="img_content">
                  <br>
                  <label class="label_content"> Tablet </label>
                </td>
              </tr>
            </table><br>
            <p class="text_content">
                Workstations are high-performance computers optimized for professional tasks like 3D modeling, video editing, 
                scientific simulations, and graphic design. They have powerful processors, large amounts of RAM, 
                and dedicated graphics cards.
            </p>
        </li>
        <li class="modern-list">
            <b>Server :</b><br>
            <table>
              <tr>
                <td>
                  <img src="../assets/products/Technology/types_of_computer/servers.jpeg" class="img_content">
                  <br>
                  <label class="label_content"> Servers </label>
                </td>
        
              </tr>
            </table><br>
            <p class="text_content">
                Servers are computers designed to provide services to other computers over a network. 
                They handle tasks like storing and serving files, hosting websites, managing databases, 
                and facilitating communication between devices.
            </p>
        </li>
        <li class="modern-list">
            <b>Mainframe :</b><br>
            <table>
              <tr>
                <td>
                  <img src="../assets/products/Technology/types_of_computer/mainframe.jpeg" class="img_content">
                  <br>
                  <label class="label_content"> Mainframe </label>
                </td>      
              </tr>
            </table><br>
            <p class="text_content">
                Mainframe computers are large and powerful machines used by large organizations and government agencies 
                to process vast amounts of data and run critical applications. 
                They are known for their reliability, scalability, and ability to handle multiple tasks simultaneously.
            </p>
        </li>
        <li class="modern-list">
            <b>Supercomputers :</b><br>
            <table>
              <tr>
                <td>
                  <img src="../assets/products/Technology/types_of_computer/suercomputers.jpeg" class="img_content">
                  <br>
                  <label class="label_content"> Supercomputers </label>
                </td>
              </tr>
            </table><br>
            <p class="text_content">
                Supercomputers are the most powerful and fastest computers available. 
                They are used for complex scientific calculations, weather modeling, cryptography, 
                and simulations requiring massive computational power.
            </p>
        </li>
        <li class="modern-list">
            <b>Embedded Computers :</b><br>
            <table>
              <tr>
                <td>
                  <img src="../assets/products/Technology/types_of_computer/embed.jpeg" class="img_content">
                  <br>
                  <label class="label_content"> Embedded Systems </label>
                </td>
              </tr>
            </table><br>
            <p class="text_content">
                Embedded computers are specialized computers built into other devices or systems to perform specific functions. 
                They are found in various everyday objects like household appliances, cars, cameras, and industrial machinery.
            </p>
        </li>
        <li class="modern-list">
            <b>Wearable Computers :</b><br>
            <table>
              <tr>
                <td>
                  <img src="../assets/products/Technology/types_of_computer/sw.jpg" class="img_content">
                  <br>
                  <label class="label_content"> Smartwatches </label>
                </td>
              </tr>
            </table><br>
            <p class="text_content">
                Wearable computers are small devices that can be worn on the body, like smartwatches and fitness trackers. 
                They typically connect to smartphones or computers and provide convenient access to information and apps.
            </p>
        </li>
        <li class="modern-list">
            <b>Game Consoles :</b><br>
            <table>
              <tr>
                <td>
                  <img src="../assets/products/Technology/types_of_computer/gc.jpeg" class="img_content">
                  <br>
                  <label class="label_content"> Game Consoles </label>
                </td>
              </tr>
            </table><br>
            <p class="text_content">
                Game consoles are dedicated computers designed specifically for playing video games. 
                They are equipped with specialized hardware and graphics capabilities to deliver an immersive gaming experience.
            </p>
        </li>
        <li class="modern-list">
            <b>Single Board Computers :</b><br>
            <table>
              <tr>
                <td>
                  <img src="../assets/products/Technology/types_of_computer/sbc.jpeg" class="img_content">
                  <br>
                  <label class="label_content"> Single Board Computers </label>
                </td>
              </tr>
            </table><br>
            <p class="text_content">
                Raspberry Pi and similar single-board computers are affordable, credit-card-sized devices used for education, 
                hobbyist projects, and DIY electronics. They are capable of running basic computing tasks 
                and can be used to learn programming and electronics.
            </p>
        </li>
    </ul>
    
    </div>

    <div id="tab3" class="tabcontent"> 
      <h1 class="hi">Computer Hardware and Software</h1>

    <!-- Hardware Section -->
    <h2 class="subheading">Hardware:</h2>
    <ul>
      <li class="modern-list"><p class="text_content">Central Processing Unit (CPU)</p></li>
      <li class="modern-list"><p class="text_content">Random Access Memory (RAM)</p></li>
      <li class="modern-list"><p class="text_content">Hard Disk Drive (HDD) or Solid-State Drive (SSD)</p></li>
      <li class="modern-list"><p class="text_content">Motherboard</p></li>
      <li class="modern-list"><p class="text_content">Graphics Processing Unit (GPU)</p></li>
      <li class="modern-list"><p class="text_content">Power Supply Unit (PSU)</p></li>
      <li class="modern-list"><p class="text_content">Input Devices (e.g., keyboards, mice, touchscreens)</p></li>
      <li class="modern-list"><p class="text_content">Output Devices (e.g., monitors, printers, speakers)</p></li>
      <li class="modern-list"><p class="text_content">Networking Hardware (e.g., routers, network cards)</p></li>
      <li class="modern-list"><p class="text_content">Optical Drives (e.g., CD/DVD drives)</p></li>
  </ul>

  <!-- Software Section -->
  <h2>Software:</h2>
  <p class="text_content">Software refers to the non-tangible instructions and programs that tell the computer's hardware what to do and how to perform specific tasks. Software can be broadly categorized into two main types:</p>
  <ul>
      <li class="modern-list"><b>Operating System (OS):</b> <p class="text_content">The operating system is the fundamental software that manages computer hardware and provides services to applications. Examples of operating systems include Windows, macOS, Linux, iOS, and Android.</p></li>
      <li class="modern-list"><b>Application Software:</b> <p class="text_content">Application software includes all the programs that perform specific tasks or functions for users. Examples include web browsers, word processors, photo editors, video players, games, and productivity software.</p></li>
  </ul>
  <p class="text_content">Software can further be divided into two categories based on how it is distributed and used:</p>
  <ul>
      <li class="modern-list"><b>Proprietary Software:</b> <p class="text_content">Proprietary software is developed and distributed by a company, and users must purchase licenses to use it. Examples include Microsoft Office and Adobe Photoshop.</p></li>
      <li class="modern-list"><b>Open-Source Software:</b> <p class="text_content">Open-source software is freely available to the public, and users can access, modify, and distribute the source code. Examples include the Linux operating system, Mozilla Firefox, and LibreOffice.</p></li>
  </ul>
    </div>

    <div id="tab4" class="tabcontent">
      <h1 class="hi">Input Devices</h1>

      <h2 class="subheading">Keyboard</h2>
      <p class="text_content">
          <img class="img_content" src="../assets/products/Technology/input_d/keyboard.jpg" alt="Keyboard">
          <br>  
            A keyboard is a common input device that allows users to input text and commands into a computer. 
          When you press a key on the keyboard, it sends a signal to the computer, and the CPU processes the input, 
          converting it into characters or executing specific commands. It works based on the electrical signals generated 
          when you press a key, which are then interpreted by the computer's hardware and software to perform the desired action.
      </p>

      <h2 class="subheading">Mouse</h2>
      <p class="text_content">
        <img class="img_content" src="../assets/products/Technology/input_d/mouse.jpeg" alt="Mouse">
        <br> 
            The mouse is another essential input device used to control the computer's pointer on the screen. 
          When you move the mouse, its internal components detect the motion and send signals to the computer, 
          which moves the cursor accordingly. Clicking the mouse buttons generates additional signals that allow 
          you to interact with icons, menus, and other graphical elements. In essence, the mouse acts as a navigational tool 
          to interact with the graphical user interface (GUI) of the computer.
      </p>

      <h2 class="subheading">Touchscreen</h2>
      <p class="text_content">
        <img class="img_content" src="../assets/products/Technology/input_d/touch.jpeg" alt="Touchscreen">
          <br>
            A touchscreen is a display that can detect the touch of a user's finger or stylus. 
          The touchscreen uses capacitive or resistive technology to detect the electrical changes that occur 
          when you touch the screen. It allows users to interact directly with the graphical elements on the display, 
          eliminating the need for a separate input device like a mouse or keyboard. Touchscreens are commonly used 
          in smartphones, tablets, and other portable devices for intuitive and user-friendly interactions.
      </p>

      <h2 class="subheading">Trackpad</h2>
      <p class="text_content">
        <img class="img_content" src="../assets/products/Technology/input_d/trackpad.jpeg" alt="Trackpad">
        <br>  
            A trackpad is a touch-sensitive pad typically found on laptops and some desktop keyboards. 
          Similar to a touchscreen, a trackpad allows users to move the cursor by sliding their fingers on its surface. 
          It detects gestures like tapping, scrolling, and pinching, providing a more compact and convenient alternative to a mouse.
      </p>

      <h2 class="subheading">Graphic Tablet</h2>
      <p class="text_content">
        <img class="img_content" src="../assets/products/Technology/input_d/gra.jpg"  alt="Graphic Tablet">
          <br>  
            A graphic tablet, also known as a digitizing tablet or drawing tablet, is an input device used by digital artists and designers. 
          It consists of a flat surface and a stylus, allowing users to draw, sketch, or write directly on the tablet. 
          The tablet captures the movement of the stylus and transfers it to the computer, enabling precise and natural digital artwork creation.
      </p>

      <h2 class="subheading">Game Controller</h2>
      <p class="text_content">
        <img class="img_content" src="../assets/products/Technology/input_d/gamecon.jpeg" alt="Game Controller">
        <br>  
            A game controller is an input device designed specifically for gaming. 
          It typically includes buttons, triggers, joysticks, and directional pads to control the actions of characters or objects in video games. 
          Game controllers can be wired or wireless and are used with gaming consoles, PCs, and mobile devices for an immersive gaming experience.
      </p>

      <h2 class="subheading">Webcam</h2>
      <p class="text_content">
        <img class="img_content" src="../assets/products/Technology/input_d/webc.jpeg" alt="Webcam">
        <br>
            A webcam is a camera attached to a computer or a display. 
          It captures video and allows users to participate in video conferencing, video calls, and online streaming. 
          Webcams are widely used for virtual meetings, online classes, and live streaming activities.
      </p>

      <h2 class="subheading">Microphone</h2>
      <p class="text_content">
        <img class="img_content" src="../assets/products/Technology/input_d/mic.jpg" alt="Microphone">
        <br>
            A microphone is an input device that converts sound waves into electrical signals. 
          It allows users to record audio, participate in voice calls, and interact with voice-controlled applications. 
          Microphones are used in various devices, including computers, smartphones, and headsets.
      </p>

      <h2 class="subheading">Scanner</h2>
      <p class="text_content">
        <img class="img_content" src="../assets/products/Technology/input_d/scanner.jpeg" alt="Scanner">
        <br>
            A scanner is an input device that captures images or documents and converts them into digital formats. 
          It works by moving a light-sensitive sensor across the object to be scanned, recording the variations in light to create a digital image. 
          Scanners are commonly used to digitize photos, documents, and artwork for storage or editing on a computer.
      </p>

      <h2 class="subheading">Biometric Input Devices</h2>
      <p class="text_content">
        <img class="img_content" src="../assets/products/Technology/input_d/biomet.jpg" alt="Biometric Input Devices">
        <br>
            Biometric input devices use unique biological characteristics, such as fingerprints, iris patterns, or facial features, 
          to authenticate users and provide access to computers or secure systems. These devices offer a high level of security 
          by relying on the distinctiveness of each individual's biological traits.
      </p>

     

    </div>
    
    <div id="tab5" class="tabcontent">
        <h1 class="hi">Output Devices</h1>

        <h2 class="subheading">Monitor</h2>
        <p class="text_content">
            <img class="img_content" src="../assets/products/Technology/output_d/monitor.jpg" alt="Monitor">
            <br>
            A monitor is an output device that displays visual information from the computer. 
            It presents images, videos, text, and other graphical content generated by the computer's hardware and software. 
            Monitors come in various sizes, resolutions, and technologies (e.g., LCD, LED, OLED) to provide clear and vibrant visuals.
        </p>

        <h2 class="subheading">Printer</h2>
        <p class="text_content">
            <img class="img_content" src="../assets/products/Technology/output_d/printer.jpg" alt="Printer">
            <br>
            A printer is an output device that produces physical copies of digital documents or images on paper. 
            It works by transferring ink or toner onto the paper to create text and images. 
            Printers are available in different types, such as inkjet, laser, and thermal printers, each offering specific advantages for various printing needs.
        </p>

        <h2 class="subheading">Speakers</h2>
        <p class="text_content">
            <img class="img_content" src="../assets/products/Technology/output_d/speaker.jpg" alt="Speakers">
            <br>
            Speakers are output devices that produce sound and audio from the computer. 
            They convert electrical signals into sound waves, allowing users to listen to music, videos, and system sounds. 
            Speakers come in various configurations, including stereo, surround sound, and soundbars, for different audio experiences.
        </p>

        <h2 class="subheading">Headphones</h2>
        <p class="text_content">
            <img class="img_content" src="../assets/products/Technology/output_d/headphones.jpeg" alt="Headphones">
            <br>
            Headphones are audio output devices worn over the ears or placed inside the ear canals. 
            They allow individuals to listen to audio privately without disturbing others. 
            Headphones are commonly used for gaming, listening to music, making calls, and watching videos.
        </p>

        <h2 class="subheading">Projector</h2>
        <p class="text_content">
            <img class="img_content" src="../assets/products/Technology/output_d/projector.jpeg" alt="Projector">
            <br>
            A projector is an output device that displays images or video on a large screen or wall. 
            It works by projecting light through an image or video source onto the display surface. 
            Projectors are often used for presentations, home theaters, and educational purposes.
        </p>

        <h2 class="subheading">Printer Plotter</h2>
        <p class="text_content">
            <img class="img_content" src="../assets/products/Technology/output_d/printer_plotter.jpeg" alt="Printer Plotter">
            <br>
            A printer plotter is a specialized output device used for large-format printing and plotting. 
            It can create high-quality prints, drawings, and diagrams on large sheets of paper or other materials. 
            Printer plotters are commonly used in engineering, architecture, and graphic design for detailed and precise output.
        </p>

        <h2 class="subheading">Braille Display</h2>
        <p class="text_content">
            <img class="img_content" src="../assets/products/Technology/output_d/braille.jpeg" alt="Braille Display">
            <br>
            A Braille display is an output device designed for individuals with visual impairments. 
            It features a series of small pins that move up and down to form Braille characters, allowing users to read digital text through touch. 
            Braille displays enhance accessibility and inclusivity in computing and information access for the visually impaired.
        </p>

        <h2 class="subheading">Haptic Feedback Devices</h2>
        <p class="text_content">
            <img class="img_content" src="../assets/products/Technology/output_d/haptic_feedback.jpg" alt="Haptic Feedback Devices">
            <br>
            Haptic feedback devices provide tactile sensations to users through vibrations or force feedback. 
            They are used in gaming controllers, virtual reality systems, and touchscreen devices to enhance the user experience by simulating touch and texture sensations.
        </p>

        <h2 class="subheading">VR Headset</h2>
        <p class="text_content">
            <img class="img_content" src="../assets/products/Technology/output_d/vr_headset.jpeg" alt="VR Headset">
            <br>
            A VR headset, short for Virtual Reality headset, is an output device used for immersive virtual reality experiences. 
            It consists of a head-mounted display that covers the eyes and sometimes the ears, providing a 3D virtual environment. 
            VR headsets are used in gaming, simulation, and training applications, offering users a sense of presence and interaction in virtual worlds.
        </p>

        <h2 class="subheading">3D Printer</h2>
        <p class="text_content">
            <img class="img_content" src="../assets/products/Technology/output_d/3d_printer.jpg" alt="3D Printer">
            <br>
            A 3D printer is an output device that creates three-dimensional objects by layering material in a additive manufacturing process. 
            It can produce a wide range of objects, including prototypes, models, and functional parts. 
            3D printing is used in various industries, including manufacturing, healthcare, and education.
        </p>

    </div>
    
    <div id="tab6" class="tabcontent">
      <h1 class="hi">CPU: The Central Processing Unit</h1>

    <!-- What is a CPU? -->
    <h2 class="topics">What is a CPU?</h2>
    <p class="text_content">
        The CPU, or Central Processing Unit, is the primary component of a computer responsible for executing instructions and performing calculations.
        It acts as the "brain" of the computer, managing and coordinating all tasks to ensure the smooth functioning of the system.
    </p>

    <!-- How Does It Work? -->
    <h2 class="topics">How Does It Work?</h2>
    <p class="text_content">
        The CPU works in conjunction with the computer's operating system and software applications to process data and execute instructions.
        When you perform tasks like opening a program, browsing the web, or editing a document, the CPU is the one doing the heavy lifting.
    </p>

    <!-- Components of a CPU -->
    <h2 class="topics">Components of a CPU</h2>
    <ul>
        <li class="modern-list"><b>Control Unit:</b> The control unit fetches instructions from memory, decodes them, and manages the execution of these instructions.</li>
        <li class="modern-list"><b>Arithmetic Logic Unit (ALU):</b> The ALU performs arithmetic operations (addition, subtraction, etc.) and logical operations (AND, OR, NOT) required for data processing.</li>
        <li class="modern-list"><b>Registers:</b> These are small, high-speed storage areas inside the CPU used to store temporary data and instructions during processing.</li>
        <li class="modern-list"><b>Cache Memory:</b> The cache is a small, ultra-fast memory that stores frequently accessed data to speed up processing.</li>
        <li class="modern-list"><b>Clock:</b> The CPU operates at a specific clock speed, which determines how many instructions it can execute per second.</li>
    </ul>

    <!-- How a Processor Works and Performs a Task -->
    <h2 class="topics">How a Processor Works and Performs a Task</h2>
    
    <img src="../assets/products/Technology/components/processor.jpg" class="img_content">
    
    <p class="text_content">
        At the heart of the CPU's operation is the "fetch-decode-execute" cycle. When the CPU performs a task, it follows these steps:
    </p>
        <ul>
            <li class="modern-list"><b>Fetch:</b> The CPU fetches the next instruction from the computer's memory. The instruction is stored in the instruction register, a special register inside the CPU.</li>
            <li class="modern-list"><b>Decode:</b> The control unit decodes the instruction to understand what operation needs to be performed.</li>
            <li class="modern-list"><b>Execute:</b> The instruction is executed by the Arithmetic Logic Unit (ALU) or other relevant components of the CPU. This step performs the actual data processing or calculation.</li>
        </ul>
    <p class="text_content">
        This fetch-decode-execute cycle repeats continuously, allowing the CPU to process a vast number of instructions per second.

        When you interact with your computer, the CPU rapidly performs these cycles to execute the necessary operations, whether it's opening a file, running a program, or displaying graphics on the screen.
    </p>

    <!-- Importance of CPU in Modern Computing -->
    <h2 class="topics">Importance of CPU in Modern Computing</h2>
    <p class="text_content">
        The CPU's performance impacts the overall speed and efficiency of a computer.
        As software becomes more demanding, having a powerful CPU becomes crucial for smooth multitasking, gaming, video editing, and other resource-intensive tasks.
    </p>

    <!-- Types of CPUs -->
    <h2 class="topics">Types of CPUs</h2>
    <p class="text_content">
        There are two main types of CPUs:
    </p>
    <ul>
        <li class="modern-list"><b>Desktop CPUs:</b> These are powerful processors designed for desktop computers and workstations, offering high performance and expandability.</li>
        <li class="modern-list"><b>Mobile CPUs:</b> These are designed for laptops and mobile devices, balancing performance with power efficiency for longer battery life.</li>
    </ul>

    <!-- Upgrading the CPU -->
    <h2 class="topics">Upgrading the CPU</h2>
    <p class="text_content">
        In some cases, you might want to upgrade your CPU to enhance your computer's performance.
        However, CPU upgrades can be complex and depend on your motherboard's compatibility and limitations.
    </p>

    <!-- Common Terms used in a Microprocessor -->
    <h2 class="topics">Common Terms used in a Microprocessor</h2>
    <p class="text_content">
        Here are some common terms that we will use in the microprocessor field:

        <ul>
            <li class="modern-list"><b>Bus:</b> 
              <p class="text_content">A bus is a set of conductors intended to transmit data, 
              address, or control information to different elements in a microprocessor. 
              Usually, a microprocessor will have three types of buses: Data Bus, Control Bus, 
              and Address Bus. An 8-bit processor will be using an 8-bit wide bus.
             </p>
            </li>
            <li class="modern-list"><b>Instruction Set:</b> 
              <p class="text_content">
                The instruction set is the group of commands that a microprocessor can understand. 
                It acts as an interface between hardware and software (program). 
                An instruction commands the processor to switch relevant transistors for doing some 
                processing in data. For example, ADD A, B; is used to add two numbers 
                stored in registers A and B.
              </p>
            </li>
            <li class="modern-list"><b>Word Length:</b> 
              <p class="text_content">
                Word Length is the number of bits in the internal data bus of a processor,
                or it is the number of bits a processor can process at a time. <br>
                For example, an 8-bit processor will have an 8-bit data bus, 
                8-bit registers, and will do 8-bit processing at a time. 
                For doing higher bits (32-bit, 16-bit) operations, 
                it will split that into a series of 8-bit operations.</li>
              </p>
            <li class="modern-list"><b>Cache Memory:</b> 
              <p class="text_content">  
                Cache memory is a random-access memory that is integrated into the processor. 
                The processor can access data in the cache memory more quickly than from regular RAM. 
                It is also known as CPU Memory. 
                Cache memory is used to store data or instructions that are frequently referenced by the software or program during the operation,
                thus increasing the overall speed of the operation.
              </p>
            </li>
            <li class="modern-list"><b>Clock Speed:</b> 
              <p class="text_content">
                Microprocessors use a clock signal to control the rate at which instructions are executed,
                synchronize other internal components, and control the data transfer between them. 
                So clock speed refers to the speed at which a microprocessor executes instructions. 
                It is usually measured in Hertz and is expressed in megahertz (MHz), gigahertz (GHz),etc.
              </p>
            </li>
        </ul>
    </p>

    <!-- Conclusion -->
    <h2 class="topics">Conclusion</h2>
    <p class="text_content">
        The CPU is the heart of any computer, responsible for executing instructions and performing tasks.
        Understanding how it works and its importance in modern computing can help you make informed decisions when choosing or upgrading your computer.
    </p>

    <p class="text_content">We hope this website provided you with valuable insights into the world of CPUs. Happy computing!</p>
    </div>

    <div id="tab7" class="tabcontent">
      <h1 class="hi">RAM: Random Access Memory</h1>

    <!-- What is RAM? -->
    <h2 class="topics">What is RAM?</h2>
    <p class="text_content">
        RAM, or Random Access Memory, is a type of computer memory that allows data to be accessed quickly by the CPU. 
        Unlike the computer's hard drive, which stores data permanently, RAM is volatile and only holds data temporarily while the computer is powered on.
        It plays a crucial role in providing fast and efficient access to data that the CPU needs to perform various tasks.
    </p>

    <!-- How Does It Work? -->
    <h2 class="topics">How Does It Work?</h2>
    <p class="text_content">
        RAM is made up of memory cells that store data in the form of binary digits (bits). Each memory cell has an address, which the CPU uses to access specific data stored in RAM.
        When you open a program or load a file, the relevant data is read from the computer's storage (e.g., hard drive) and loaded into RAM.
        The CPU can then access this data quickly as needed, allowing for faster data processing and multitasking.
    </p>

    <!-- Components of RAM -->
    <h2 class="topics">Components of RAM</h2>
    <ul class="text_content">
        <li class="modern-list"><b>Memory Cells:</b> These are the fundamental units of RAM that store data in binary form. Each memory cell can hold one bit of data, which is either 0 or 1.</li>
        <li class="modern-list"><b>Address Bus:</b> The address bus is used by the CPU to specify the memory location (address) from which it wants to read or write data in RAM.</li>
        <li class="modern-list"><b>Data Bus:</b> The data bus allows the CPU to transfer data to and from RAM. It carries the actual data between the CPU and the memory cells.</li>
        <li class="modern-list"><b>Control Unit:</b> The control unit manages the flow of data between the CPU and RAM, coordinating read and write operations.</li>
        <li class="modern-list"><b>Memory Controller:</b> The memory controller is responsible for managing the access and transfer of data between the CPU and RAM. It ensures data integrity and efficiency.</li>
    </ul>

    <!-- How RAM Works with the Processor -->
    <h2 class="topics">How RAM Works with the Processor</h2>
    <p class="text_content">
        RAM and the processor (CPU) work closely together to execute instructions and perform tasks. When you run a program, the CPU fetches the program's instructions from the computer's storage (e.g., hard drive) and loads them into RAM. The CPU then reads these instructions from RAM and executes them one by one.
        As the CPU processes data, it retrieves the necessary data from RAM, performs calculations using the data, and stores the results back in RAM. The speed at which the CPU can access data from RAM directly affects the overall system performance.
    </p>

    <!-- Types of RAM -->
    <h2 class="topics">Types of RAM</h2>
    <p class="text_content">
        There are several types of RAM, each with its own characteristics and performance levels:
    </p>

    <ul class="text_content">
        <li class="modern-list"><b>Static RAM (SRAM):</b> SRAM is faster and more expensive than other types of RAM. It uses flip-flops to store data, which require constant power to retain information. SRAM is commonly used in cache memory due to its speed.</li>
        <li class="modern-list"><b>Dynamic RAM (DRAM):</b> DRAM is the most common type of RAM used in modern computers. It uses capacitors to store data, which require regular refreshing to maintain data integrity. DRAM is cheaper and offers higher memory density but is slower than SRAM.</li>
        <li class="modern-list"><b>Synchronous DRAM (SDRAM):</b> SDRAM synchronizes with the computer's clock, allowing for faster data access and transfer rates compared to traditional DRAM.</li>
        <li class="modern-list"><b>Double Data Rate (DDR) SDRAM:</b> DDR SDRAM transfers data on both the rising and falling edges of the clock signal, effectively doubling the data transfer rate compared to SDRAM.</li>
        <li class="modern-list"><b>DDR2, DDR3, DDR4, DDR5:</b> These are successive generations of DDR SDRAM, each offering improved performance, higher data transfer rates, and lower power consumption.</li>
    </ul>

    <!-- Importance of RAM in Modern Computing -->
    <h2 class="topics">Importance of RAM in Modern Computing</h2>
    <p class="text_content">
        RAM is a critical component in modern computing, as it directly impacts the system's performance and multitasking capabilities.
        More RAM allows the computer to store and access larger amounts of data quickly, leading to faster application loading times and smoother overall performance.
        As software becomes more demanding, having an adequate amount of RAM is essential for running multiple programs simultaneously without slowdowns.
    </p>

    <!-- Conclusion -->
    <h2 class="topics">Conclusion</h2>
    <p class="text_content">
        RAM is an integral part of a computer's architecture, providing fast and temporary data access for the CPU.
        Its importance in modern computing cannot be overstated, as it significantly influences the overall performance and responsiveness of a computer.
        Understanding how RAM works, its different types, and its collaboration with the processor can help users make informed decisions when choosing or upgrading their computer's memory.
    </p>
    </div>

    <div id="tab8" class="tabcontent">
      <h1 class="hi">Storage Devices: Types and Functionality</h1>

    <!-- What are Storage Devices? -->
    <h2 class="topics">What are Storage Devices?</h2>
    <p class="text_content">
        Storage devices are essential components of a computer that are used to store and retrieve data permanently or semi-permanently. Unlike RAM, which is volatile and temporary, storage devices retain data even when the computer is powered off.
        These devices provide long-term data storage, allowing users to store files, programs, and the operating system itself.
    </p>

    <!-- How Do Storage Devices Work? -->
    <h2 class="topics">How Do Storage Devices Work?</h2>
    <p class="text_content">
        Storage devices use various technologies to store data magnetically, electronically, or optically. Data is stored in binary form (0s and 1s) and is organized into sectors and tracks on the storage medium.
        When you save a file or install a program, the data is written to the storage device, and it remains there until you delete it or overwrite it with new data.
    </p>

    <!-- Types of Storage Devices -->
    <h2 class="topics">Types of Storage Devices</h2>
    <ul>
        <li class="modern-list">
            <b>Hard Disk Drive (HDD):</b><br>
            <img src="../assets/products/Technology/storage/hdd.jpeg" class="img_content"><br>
            <p class="text_content">
                  HDDs are magnetic storage devices that use rapidly rotating disks to store and retrieve data. 
                They are widely used in computers for their large storage capacity and relatively lower cost.
            </p>
        </li>
        <li class="modern-list">
            <b>Solid-State Drive (SSD):</b><br>
            <img src="../assets/products/Technology/storage/ssd.jpeg" class="img_content"><br>
            <p class="text_content">
                    SSDs use flash memory to store data, providing faster read and write speeds compared to HDDs. 
                  They are more durable, energy-efficient, and faster, making them popular for laptops and modern desktops.
            </p>
        </li>
        <li class="modern-list">
            <b>USB Flash Drive:</b><br>
            <img src="../assets/products/Technology/storage/usb.jpeg" class="img_content"><br>
            <p class="text_content">
                  Also known as a thumb drive or pen drive, this portable storage device uses flash memory to store data. 
                It connects to a computer's USB port and is widely used for data transfer and backup.
            </p>
        </li>
        <li class="modern-list">
          <b>Floppy Disk Drive:</b><br>
          <img src="../assets/products/Technology/storage/floppy.jpeg" class="img_content"><br>
          <p class="text_content">
              Floppy disk drives were once popular removable storage devices that used floppy disks to store data. 
              They had limited capacity and were commonly used in the early days of computing.
          </p>
        </li>
        <li class="modern-list">
            <b>Optical Discs:</b><br>
            <img src="../assets/products/Technology/storage/cd.jpeg" class="img_content"><br>
            <p class="text_content">
                  Optical storage devices use lasers to read and write data on optical discs such as CDs, 
                DVDs, and Blu-ray discs. They are used for data storage, music, movies, and software distribution.
            </p>
        </li>
        <li class="modern-list">
            <b>Memory Cards:</b><br>
            <img src="../assets/products/Technology/storage/mc.jpg" class="img_content"><br>
            <p class="text_content">
                  Memory cards are small, removable storage devices commonly used in cameras, 
                smartphones, and other portable devices. They use flash memory technology to store data.
            </p>
        </li>
        <li class="modern-list">
            <b>External Hard Drive:</b><br>
            <img src="../assets/products/Technology/storage/ehd.jpeg" class="img_content"><br>
            <p class="text_content">
                  An external hard drive is a standalone HDD or SSD housed in an external enclosure. 
                It connects to a computer via USB, Thunderbolt, or other interfaces, providing additional storage capacity.
            </p>
        </li>
        <li class="modern-list">
            <b>Network Attached Storage (NAS):</b><br>
            <img src="../assets/products/Technology/storage/nas.jpg" class="img_content"><br>
            <p class="text_content">
                  NAS devices are specialized storage devices connected to a network. 
                They provide centralized data storage and can be accessed by multiple devices on the network.
            </p>
        </li>
        <li class="modern-list">
            <b>Cloud Storage:</b><br>
            <img src="../assets/products/Technology/storage/cs.jpeg" class="img_content"><br>
            <p class="text_content">
                  Cloud storage services allow users to store data online, 
                accessible from any device with an internet connection. 
                Examples include Dropbox, Google Drive, and Microsoft OneDrive.
            </p>
        </li>
        <li class="modern-list">
            <b>Magnetic Tape Drive:</b><br>
            <img src="../assets/products/Technology/storage/mtd.jpeg" class="img_content"><br>
            <p class="text_content">
                  Magnetic tape drives use magnetic tapes for data storage. 
                They are primarily used for large-scale backups and archiving due to their high capacity.
            </p>
        </li>
    </ul>

    <!-- Importance of Storage Devices in Computing -->
    <h2 class="topics">Importance of Storage Devices in Computing</h2>
    <p class="text_content">
        Storage devices are crucial components in computing, as they provide a means to store and retrieve data for various purposes.
        Having sufficient and reliable storage is essential for saving files, installing software, and ensuring data availability and security.
        The type and capacity of the storage device influence the overall performance and usability of a computer system.
    </p>

    <!-- Conclusion -->
    <h2 class="topics">Conclusion</h2>
    <p class="text_content">
        Storage devices are integral to modern computing, enabling users to store and access data for different applications and needs.
        Understanding the various types of storage devices and their functionalities can help users make informed choices when selecting storage solutions for their computers and devices.
    </p>
    </div>

    <div id="tab9" class="tabcontent">
      <h1 class="hi">Types of Networks and The Internet</h1>

      <!-- Types of Networks -->
      <h2 class="topics">Types of Networks</h2>
      <p class="text_content">
          Networks are a collection of interconnected devices that share resources and communicate with each other. 
          There are different types of networks based on their size and geographical coverage.
      </p>
      <ul class="text_content">
          <li class="modern-list">Local Area Network (LAN):</li>
          <p class="text_content">
            <br><img src="../assets/products/Technology/networks/LAN.png" class="img_content"><br>
              A LAN is a network that connects devices within a limited geographical area, 
              such as a home, office, or school. LANs are commonly used to share resources like printers,
              files, and internet connections among devices.
          </p>
  
          <li class="modern-list">Wide Area Network (WAN):</li>
          <p class="text_content">
            <br><img src="../assets/products/Technology/networks/WAN.jpg" class="img_content"><br>
              WANs span larger areas and connect LANs over long distances. 
              The internet itself is an example of a global WAN that allows computers and 
              networks from all around the world to communicate.
          </p>
  
          <li class="modern-list">Metropolitan Area Network (MAN):</li>
          <p class="text_content">
            <br><img src="../assets/products/Technology/networks/MAN.png" class="img_content"><br>
              MANs cover a city or a metropolitan area, connecting multiple LANs together. 
              They are used by organizations or service providers to offer high-speed internet connectivity in cities.
          </p>
  
          <li class="modern-list">Personal Area Network (PAN):</li>
          <p class="text_content">
            <br><img src="../assets/products/Technology/networks/PAN.jpg" class="img_content"><br>
              PANs are small networks designed for personal use, typically connecting devices like smartphones,
              tablets, and wearable gadgets in close proximity.
          </p>
  
          <li class="modern-list">Campus Area Network (CAN):</li>
          <p class="text_content"></p>
          <br><img src="../assets/products/Technology/networks/CAN.jpg" class="img_content"><br>
              CANs are networks that cover a university campus or a large institution, 
              interconnecting various departments and buildings.
          </p>
      </ul>
  
      <!-- The Internet -->
      <h2 class="topics">The Internet</h2>
      <p class="text_content">
          The internet is a global network that connects millions of devices worldwide. It is an extensive network of networks, allowing users to access a vast amount of information and services.
      </p>
      <p class="text_content">
          The internet operates on a client-server model, where client devices (such as computers, smartphones, or tablets) request information or services from servers (large, powerful computers) that store and deliver content.
      </p>
      <p class="text_content">
          The internet enables various services like email, web browsing, social networking, online shopping, video streaming, and much more. It has revolutionized the way we communicate, learn, and conduct business.
      </p>
  
      <!-- Conclusion -->
      <h2 class="topics">Conclusion</h2>
      <p class="text_content">
          Understanding the types of networks and the significance of the internet is crucial in today's interconnected world. Networks play a vital role in enabling seamless communication and access to information across the globe.
      </p>
  
    </div>

    <div id="tab10" class="tabcontent">
      <h1 class="hi">The Internet: Connecting the World</h1>

      <!-- What is the Internet? -->
      <h2 class="topics">What is the Internet?</h2>
      <p class="text_content">
          The Internet is a vast global network of interconnected computer networks. It enables communication, collaboration, and access to information on a global scale.
      </p>
  
      <!-- How Does the Internet Work? -->
      <h2 class="topics">How Does the Internet Work?</h2>
      <p class="text_content">
          The Internet operates on a decentralized and distributed model, where multiple networks from different locations are interconnected. It uses a protocol called the Internet Protocol (IP) to route data packets between devices and networks.
      </p>
      <p class="text_content">
          When you access a website or send an email, data is broken down into packets and sent through various routers and switches across the internet. These packets find the most efficient path to reach their destination, where they are reassembled to deliver the information or request.
      </p>
  
      <!-- Internet Protocols -->
      <h2 class="topics">Internet Protocols</h2>
      <p class="text_content">
          Internet protocols are a set of rules that govern how data is transmitted, received, and processed over the Internet. Some of the essential internet protocols include:
      </p>
      <ul class="text_content">
          <li class="modern-list">HTTP (Hypertext Transfer Protocol):</li>
          <p class="text_content">
              HTTP is the foundation of data communication on the World Wide Web. It defines how web browsers and web servers communicate to request and deliver web pages, images, and other resources.
          </p>
  
          <li class="modern-list">DNS (Domain Name System):</li>
          <p class="text_content">
              DNS translates human-readable domain names (e.g., www.example.com) into IP addresses (e.g., 192.0.2.1) used by computers to locate and connect to web servers.
          </p>
  
          <li class="modern-list">TCP/IP (Transmission Control Protocol/Internet Protocol):</li>
          <p class="text_content">
              TCP/IP is the suite of protocols that enables reliable and secure data transmission over the Internet. It includes IP (Internet Protocol), which handles routing, and TCP, which ensures data is delivered without errors.
          </p>
      </ul>
  
      <!-- Invention of the World Wide Web -->
      <h2 class="topics">Invention of the World Wide Web</h2>
      <p class="text_content">
          The World Wide Web (WWW) was invented by Sir Tim Berners-Lee in 1989 while working at CERN, the European Organization for Nuclear Research. He developed the first web browser and web server, laying the foundation for the modern web.
      </p>
      <p class="text_content">
          The WWW revolutionized the way we access and share information, providing a user-friendly interface for navigating hypertext documents through hyperlinks.
      </p>
  
      <!-- HTML (Hypertext Markup Language) -->
      <h2 class="topics">HTML (Hypertext Markup Language)</h2>
      <p class="text_content">
          HTML is the standard markup language used to create and structure content on the World Wide Web. It uses tags to define elements such as headings, paragraphs, images, links, and more, allowing browsers to render web pages properly.
      </p>
      <p class="text_content">
          Web developers use HTML to build the structure of web pages, while CSS (Cascading Style Sheets) is used for styling and JavaScript for interactivity.
      </p>
  
      <!-- Protocols for Mail and File Transfers -->
      <h2 class="topics">Protocols for Mail and File Transfers</h2>
      <p class="text_content">
          Apart from HTTP and TCP/IP, the Internet utilizes various protocols for specific purposes, such as email and file transfers. Some of these protocols include:
      </p>
      <ul class="text_content">
          <li class="modern-list">SMTP (Simple Mail Transfer Protocol):</li>
          <p class="text_content">
              SMTP is used for sending and relaying email messages between servers. It ensures the reliable delivery of emails to the recipient's mailbox.
          </p>
  
          <li class="modern-list">POP3 (Post Office Protocol 3) and IMAP (Internet Message Access Protocol):</li>
          <p class="text_content">
              POP3 and IMAP are email retrieval protocols that allow users to access and download emails from a mail server to their devices.
          </p>
  
          <li class="modern-list">FTP (File Transfer Protocol):</li>
          <p class="text_content">
              FTP is used for transferring files between a client and a server over the internet. It provides a way to upload, download, and manage files on remote servers.
          </p>
  
          <li class="modern-list">SFTP (SSH File Transfer Protocol):</li>
          <p class="text_content">
              SFTP is a secure version of FTP that encrypts data during file transfers, providing enhanced security.
          </p>
      </ul>
  
      <!-- Conclusion -->
      <h2 class="topics">Conclusion</h2>
      <p class="text_content">
          The Internet has transformed the world, connecting people and information like never before. Understanding its protocols and technologies is essential in navigating the digital landscape and utilizing its vast potential.
      </p>
  
      <p class="text_content">We hope this website provided you with valuable insights into the fascinating world of the Internet. Happy browsing and exploring!</p>
  
    </div>

    <div id="tab11" class="tabcontent">
      <h1 class="hi">Introduction to Software</h1>

    <!-- What is Software? -->
    <h2 class="topics">What is Software?</h2>
    <p class="text_content">
        Software refers to a collection of programs, data, and instructions that enable a computer to perform specific tasks or operations. It is a set of electronic instructions that tell the hardware what to do and how to do it.
    </p>

    <!-- Difference Between Instructions, Programs, and Software -->
    <h2 class="topics">Difference Between Instructions, Programs, and Software</h2>
    <p class="text_content">
        To understand the relationship between these terms, let's define them:
    </p>
    <ul class="text_content">
        <li class="modern-list">Instructions:</li>
        <p class="text_content">
            Instructions are individual commands or operations that a computer's central processing unit (CPU) can execute. These are the basic building blocks of programs and tell the CPU what specific actions to perform, such as arithmetic calculations or data transfers.
        </p>

        <li class="modern-list">Programs:</li>
        <p class="text_content">
            Programs are sets of instructions written in a specific programming language that are combined to perform a particular task or achieve a specific goal. A program can be a simple script or a complex software application.
        </p>

        <li class="modern-list">Software:</li>
        <p class="text_content">
            Software is a broader term that encompasses all types of programs, data, and documentation needed to operate a computer system effectively. It includes applications, operating systems, utilities, and other tools that enable users to interact with hardware and perform various tasks.
        </p>
    </ul>

    <!-- Types of Software -->
    <h2 class="topics">Types of Software</h2>
    <p class="text_content">
        Software can be categorized into several types based on its purpose and functionality. Some common types of software include:
    </p>
    <ul class="text_content">
        <li class="modern-list">Operating System Software:</li>
        <p class="text_content">
            The operating system (OS) is a fundamental type of software that manages computer hardware and provides essential services to other software applications. It acts as an intermediary between users, applications, and hardware.
        </p>

        <li class="modern-list">Application Software:</li>
        <p class="text_content">
            Application software includes programs designed to perform specific tasks for users. It can be general-purpose (e.g., word processors, spreadsheets) or specialized (e.g., graphic design software, video editors).
        </p>

        <li class="modern-list">Utility Software:</li>
        <p class="text_content">
            Utility software provides tools to perform maintenance and management tasks on a computer. Examples include antivirus software, disk cleaners, and system optimization tools.
        </p>

        <li class="modern-list">Programming Software:</li>
        <p class="text_content">
            Programming software includes tools for developers to write, debug, and test computer programs. Integrated Development Environments (IDEs) and compilers are examples of programming software.
        </p>

        <li class="modern-list">System Software:</li>
        <p class="text_content">
            System software includes programs that help manage and control computer hardware. It includes device drivers, firmware, and system utilities.
        </p>

        <li class="modern-list">Embedded Software:</li>
        <p class="text_content">
            Embedded software is built into hardware devices and controls their functionality. It is commonly found in appliances, automobiles, and consumer electronics.
        </p>

        <li class="modern-list">Entertainment Software:</li>
        <p class="text_content">
            Entertainment software includes video games, multimedia applications, and virtual reality experiences designed for entertainment and leisure.
        </p>
    </ul>

    <!-- Conclusion -->
    <h2 class="topics">Conclusion</h2>
    <p class="text_content">
        Software is a critical component of modern computing, enabling computers to perform diverse tasks and functions. Understanding the various types of software and their roles is essential for using computers effectively and efficiently.
    </p
    </div>
    </div>

    <div id="tab12" class="tabcontent">
      <h1 class="hi">System Software: The Backbone of Computing</h1>

    <!-- What is System Software? -->
    <h2 class="topics">What is System Software?</h2>
    <p class="text_content">
        System software is a category of computer software that plays a crucial role in managing and 
        controlling the hardware and supporting application software. <br>
        It provides a bridge between the user and the hardware, enabling smooth interaction and efficient operation of the computer system.
    </p>

    <!-- Functions of System Software -->
    <h2 class="topics">Functions of System Software</h2>
    <p class="text_content">
        System software performs several vital functions, including:
    </p>
    <ul class="text_content">
        <li class="modern-list">Operating System Management:</li>
        <p class="text_content">
            The primary function of system software is to manage the computer's operating system (OS). 
            The OS acts as an intermediary between users, application software, and hardware. 
            It provides essential services like memory management, process scheduling, 
            file management, and user interface.
        </p>

        <li class="modern-list">Device Driver Communication:</li>
        <p class="text_content">
              System software includes device drivers, which are responsible for facilitating communication 
            between the hardware devices (such as printers, graphics cards, and keyboards) and 
            the operating system. 
            Device drivers allow the OS and applications to interact with the hardware correctly.
        </p>

        <li class="modern-list">System Utilities:</li>
        <p class="text_content">
              System utilities are tools provided by system software to perform various maintenance
            tasks on the computer. 
            Examples include disk defragmentation, disk cleanup, system backup, 
            and security software.
        </p>

        <li class="modern-list">Security Management:</li>
        <p class="text_content">
            System software includes security features to protect the computer system from 
            unauthorized access, viruses, malware, and other threats. 
            It manages user authentication, access controls, and encryption to safeguard data and resources.
        </p>

        <li class="modern-list">Memory Management:</li>
        <p class="text_content">
            System software is responsible for managing the computer's memory, 
            ensuring that applications have the necessary memory to run efficiently and preventing conflicts or memory leaks.
        </p>

        <li class="modern-list">System Updates and Patches:</li>
        <p class="text_content">
            System software is responsible for managing updates and patches for the operating system and other system components. 
            Regular updates ensure that the system remains secure and performs optimally.
        </p>
    </ul>

    <!-- Types of System Software -->
    <h2 class="topics">Types of System Software</h2>
    <p class="text_content">
        System software can be categorized into several types based on its functions and purpose. 
        Some common types of system software include:
    </p>
    <ul class="text_content">
        <li class="modern-list">Operating Systems (OS):</li>
        <p class="text_content">
            The operating system is the core system software that manages computer hardware and provides essential services to applications. 
            Examples include Windows, macOS, Linux, and iOS.
        </p>

        <li class="modern-list">Device Drivers:</li>
        <p class="text_content">
            Device drivers are small software programs that enable communication between hardware devices and the operating system. 
            They ensure that devices function correctly and efficiently.
        </p>

        <li class="modern-list">Firmware:</li>
        <p class="text_content">
            Firmware is software that is embedded into hardware devices, 
            providing essential instructions for their operation. 
            It is often stored in read-only memory (ROM) and is responsible for booting the device and controlling its basic functions.
        </p>

        <li class="modern-list">Virtual Machine Managers:</li>
        <p class="text_content">
            Virtual machine managers, or hypervisors, allow multiple virtual machines to run on a 
            single physical machine. 
            They enable efficient resource allocation and isolation between virtual machines.
        </p>
    </ul>

    <!-- Conclusion -->
    <h2 class="topics">Conclusion</h2>
    <p class="text_content">
        System software is the backbone of computing, responsible for managing and controlling the computer's hardware and supporting application software. Understanding its functions and types is essential for maintaining and optimizing computer systems effectively.
    </p>
    </div>

    <div id="tab13" class="tabcontent">
      <h1 class="hi">Application Software: Enhancing Productivity and Creativity</h1>

    <!-- What is Application Software? -->
    <h2 class="topics">What is Application Software?</h2>
    <p class="text_content">
        Application software is a category of computer software designed to 
        perform specific tasks or functions for end-users. 
        Unlike system software, which manages the computer and its hardware, 
        application software is created to meet various user needs, 
        enabling them to accomplish a wide range of tasks.
    </p>

    <!-- Functions of Application Software -->
    <h2 class="topics">Functions of Application Software</h2>
    <p class="text_content">
        Application software serves numerous purposes, and some of its key functions include:

    </p>
    <ul class="text_content">
        <li class="modern-list">Productivity Tools:</li>
        <p class="text_content">
            Application software includes productivity tools such as word processors, spreadsheets, and presentation software. These tools enable users to create, edit, and manage documents, data, and presentations.
        </p>

        <li class="modern-list">Graphic Design and Multimedia Software:</li>
        <p class="text_content">
            Graphic design and multimedia software allow users to create and manipulate visual content, including images, videos, animations, and audio. These tools are used by artists, designers, and content creators to express their creativity.
        </p>

        <li class="modern-list">Web Browsers:</li>
        <p class="text_content">
            Web browsers are application software that enables users to access and navigate the World Wide Web. They allow users to view websites, access online services, and interact with web-based applications.
        </p>

        <li class="modern-list">Communication Software:</li>
        <p class="text_content">
            Communication software includes email clients, instant messaging applications, and video conferencing tools. These applications facilitate real-time communication and collaboration among users across the globe.
        </p>

        <li class="modern-list">Entertainment Software:</li>
        <p class="text_content">
            Entertainment software provides users with various forms of entertainment, including video games, media players, and streaming platforms. These applications are designed to entertain and engage users during their leisure time.
        </p>

        <li class="modern-list">Educational Software:</li>
        <p class="text_content">
            Educational software offers interactive learning experiences and educational resources to support students, teachers, and learners of all ages. It includes educational games, virtual labs, and language learning apps.
        </p>
    </ul>

    <!-- Conclusion -->
    <h2 class="topics">Conclusion</h2>
    <p class="text_content">
        Application software plays a significant role in enhancing productivity, creativity, and communication for users. Its diverse functions cater to various needs, making it an indispensable part of modern computing.
    </p>
    </div>

    <div id="tab14" class="tabcontent">
      <h1 class="hi">Utility Software: Enhancing System Performance and Maintenance</h1>

    <!-- What is Utility Software? -->
    <h2 class="topics">What is Utility Software?</h2>
    <p class="text_content">
        Utility software, also known as system utilities, is a type of software designed to perform maintenance 
        and optimization tasks on a computer system. 
        It enhances the system's performance, resolves issues, and improves overall efficiency.
    </p>

    <!-- Functions of Utility Software -->
    <h2 class="topics">Functions of Utility Software</h2>
    <p class="text_content">
        Utility software performs a range of essential functions, including:
    </p>
    <ul class="text_content">
        <li class="modern-list">Disk Cleanup and Defragmentation:</li>
        <p class="text_content">
            Disk cleanup utilities remove unnecessary files and temporary data from the computer's storage to free up space. Defragmentation tools optimize data storage to improve disk access times and overall system performance.
        </p>

        <li class="modern-list">System Backup and Recovery:</li>
        <p class="text_content">
            Backup utilities create copies of important data to prevent data loss in case of hardware failure or system errors. Recovery tools help restore data from backups when needed.
        </p>

        <li class="modern-list">Security Software:</li>
        <p class="text_content">
            Security utilities, such as antivirus software and firewall applications, protect the computer from viruses, malware, and unauthorized access. They ensure the system remains secure and free from threats.
        </p>

        <li class="modern-list">Driver Management:</li>
        <p class="text_content">
            Driver management utilities help update, install, or repair device drivers. They ensure that hardware devices function properly and efficiently by keeping their drivers up to date.
        </p>

        <li class="modern-list">Registry Cleanup and Optimization:</li>
        <p class="text_content">
            Registry cleaners scan and repair the Windows registry, removing invalid entries and optimizing the registry's performance. A healthy registry enhances system stability and responsiveness.
        </p>

        <li class="modern-list">System Performance Monitoring:</li>
        <p class="text_content">
            Performance monitoring tools track the system's resource usage, such as CPU, memory, and disk activity. They help identify performance bottlenecks and optimize resource allocation.
        </p>
    </ul>

    <!-- Conclusion -->
    <h2 class="topics">Conclusion</h2>
    <p class="text_content">
        Utility software is essential for maintaining a healthy and efficient computer system. Its various functions contribute to improved system performance, data protection, and overall user experience.
    </p>
    </div>

    <div id="tab15" class="tabcontent">
      <h1 class="hi">Operating Systems: The Core of Computer Functionality</h1>

    <!-- What is an Operating System? -->
    <h2 class="topics">What is an Operating System?</h2>
    <p class="text_content">
        An operating system (OS) is a software program that serves as the foundation and
        manager of a computer system. 
        It acts as an intermediary between users, application software, 
        and hardware components, providing an environment for them to 
        interact effectively.
    </p>

    <!-- Functions of Operating Systems -->
    <h2 class="topics">Functions of Operating Systems</h2>
    <p class="text_content">
        Operating systems perform several vital functions, including:
    </p>
    <ul class="text_content">
        <li class="modern-list">Processor Management:</li>
        <p class="text_content">
            The OS manages the computer's central processing unit (CPU) and allocates processor time to different tasks 
            and processes. It ensures fair distribution of resources and prevents one application
            from monopolizing the CPU.
        </p>

        <li class="modern-list">Memory Management:</li>
        <p class="text_content">
            Operating systems manage the computer's memory, allocating and deallocating memory 
            space to running processes. 
            It ensures efficient memory utilization and prevents conflicts between processes.
        </p>

        <li class="modern-list">File System Management:</li>
        <p class="text_content">
            The OS provides file system management, organizing and storing files on storage devices 
            like hard drives. 
            It allows users and applications to create, read, write, and delete files, 
            providing a hierarchical structure for data storage.
        </p>

        <li class="modern-list">Device Management:</li>
        <p class="text_content">
            Operating systems interact with hardware devices such as printers, keyboards, and
             monitors. They manage device drivers, enabling communication between devices and 
             the OS, ensuring proper device operation.
        </p>

        <li class="modern-list">User Interface:</li>
        <p class="text_content">
            The OS provides a user interface (UI) that allows users to interact with the computer
            system. This can be a graphical user interface (GUI) with icons and windows 
            or a command-line interface (CLI) based on text commands.
        </p>

        <li class="modern-list">Security and Access Control:</li>
        <p class="text_content">
            Operating systems implement security measures to protect the system from unauthorized
             access, viruses, and malware. They use access control mechanisms to ensure that only
            authorized users can access specific resources.
        </p>
    </ul>

    <!-- Types of Operating Systems -->
    <h2 class="topics">Types of Operating Systems</h2>
    <p class="text_content">
        Operating systems can be categorized into several types based on their functionalities and use cases. 
        Some common types of operating systems include:
    </p>
    <ul class="text_content">
        <li class="modern-list">Single-User, Single-Tasking Operating Systems:</li>
        <p class="text_content">
            These operating systems are designed to support a single user and allow the execution of only one task at a time. 
            Early personal computers used single-user, single-tasking operating systems.
        </p>

        <li class="modern-list">Single-User, Multi-Tasking Operating Systems:</li>
        <p class="text_content">
            These operating systems allow a single user to run multiple applications simultaneously. 
            The OS switches between tasks, giving the illusion of parallel execution.
        </p>

        <li class="modern-list">Multi-User Operating Systems:</li>
        <p class="text_content">
            Multi-user operating systems support multiple users accessing the system concurrently. 
            These systems provide secure access control and resource sharing among users.
        </p>

        <li class="modern-list">Real-Time Operating Systems (RTOS):</li>
        <p class="text_content">
            RTOS is designed to handle real-time applications, where immediate response is crucial. 
            These systems are used in embedded systems, industrial automation, and critical applications.
        </p>

        <li class="modern-list">Distributed Operating Systems:</li>
        <p class="text_content">
            Distributed operating systems run on multiple interconnected computers and provide a 
            unified computing environment. 
            They enable resource sharing and distributed processing across the network.
        </p>

        <li class="modern-list">Mobile Operating Systems:</li>
        <p class="text_content">
            Mobile operating systems are designed for smartphones, tablets, and other mobile devices. 
            They are optimized for low power consumption and touch-based interfaces.
        </p>
    </ul>

    <!-- Importance of Operating Systems -->
    <h2 class="topics">Importance of Operating Systems</h2>
    <p class="text_content">
        Operating systems are crucial for the efficient functioning of modern computers and devices. 
        Their importance lies in the following aspects:
    </p>
    <ul class="text_content">
        <li class="modern-list">Resource Management:</li>
        <p class="text_content">
            Operating systems manage computer resources, ensuring optimal utilization and fair allocation 
            to different processes and users.
        </p>

        <li class="modern-list">Hardware Abstraction:</li>
        <p class="text_content">
            OS abstracts the complexities of hardware, providing a uniform interface for applications to 
            interact with the computer's hardware components.
        </p>

        <li class="modern-list">User Experience:</li>
        <p class="text_content">
            The user interface provided by the operating system allows users to interact with the computer 
            in a user-friendly and intuitive manner.
        </p>

        <li class="modern-list">Security and Privacy:</li>
        <p class="text_content">
            Operating systems implement security features to protect data and resources from 
            unauthorized access and malicious threats.
        </p>

        <li class="modern-list">Application Compatibility:</li>
        <p class="text_content">
            OS provides a platform for running various applications, ensuring compatibility and 
            smooth functioning across different software.
        </p>

        <li class="modern-list">System Stability:</li>
        <p class="text_content">
            The OS ensures system stability by handling errors, crashes, and unexpected events, 
            preventing the entire system from failing.
        </p>
    </ul>

    <!-- Internet Protocols -->
    <h2 class="topics">Internet Protocols</h2>
    <p class="text_content">
        Operating systems also play a crucial role in supporting internet protocols, 
        such as HTTP (Hypertext Transfer Protocol) for web browsing, 
        DNS (Domain Name System) for domain name resolution, and various protocols for email 
        and file transfers. 
        These protocols allow seamless communication and data exchange over the internet.

    </p>

    <!-- Conclusion -->
    <h2 class="topics">Conclusion</h2>
    <p class="text_content">
        Operating systems are the backbone of modern computing, providing an essential platform for users and
         applications to interact with hardware resources effectively. 
         They enable seamless multitasking, resource management, and overall system stability, making them 
         indispensable for today's technology-driven world.
    </p>
    </div>

    <div id="tab16" class="tabcontent">
      <h1 class="hi">Computer Viruses and Malware: Threats and Protections</h1>

    <!-- What are Computer Viruses and Malware? -->
    <h2 class="topics">What are Computer Viruses and Malware?</h2>
    <p class="text_content">
        Computer viruses and malware are malicious software programs designed to disrupt, 
        damage, or gain unauthorized access to computer systems and data. 
        They spread from one computer to another, often without the user's knowledge, and 
        pose significant security risks to individuals and organizations.
    </p>

    <!-- How Computer Viruses and Malware Work -->
    <h2 class="topics">How Computer Viruses and Malware Work</h2>
    <p class="text_content">
        Computer viruses and malware employ various methods to infect and harm computers. 
        Some common techniques include:
    </p>
    <ul class="text_content">
        <li class="modern-list">Replication and Propagation:</li>
        <p class="text_content">
            Viruses and malware replicate themselves and spread to other files, programs, or systems, 
            increasing their reach and potential damage.
        </p>

        <li class="modern-list">Exploiting Vulnerabilities:</li>
        <p class="text_content">
            Malware may exploit security vulnerabilities in operating systems, applications, or 
            web browsers to gain unauthorized access to a computer or network.
        </p>

        <li class="modern-list">Social Engineering:</li>
        <p class="text_content">
            Some malware tricks users into executing or downloading them by disguising as legitimate files, 
            emails, or links.
        </p>

        <li class="modern-list">Payload Activation:</li>
        <p class="text_content">
            Malware can carry a destructive payload that executes at a specific time, 
            causing data corruption, denial of service, or unauthorized access.
        </p>

        <li class="modern-list">Botnets and Remote Control:</li>
        <p class="text_content">
            Some malware creates botnets, turning infected computers into remote-controlled "zombies" 
            used for various malicious activities.
        </p>

        <li class="modern-list">Ransomware Attacks:</li>
        <p class="text_content">
            Ransomware encrypts user data and demands a ransom for decryption, posing a severe threat to 
            data privacy and integrity.
        </p>
    </ul>

    <!-- Types of Malware -->
    <h2 class="topics">Types of Malware</h2>
    <p class="text_content">
        There are various types of malware, each designed for specific purposes. Some common types include:
    </p>
    <ul class="text_content">
        <li class="modern-list">Viruses:</li>
        <p class="text_content">
            Viruses attach themselves to clean files and spread when the infected files are executed or 
            shared.
        </p>

        <li class="modern-list">Worms:</li>
        <p class="text_content">
            Worms are self-replicating programs that spread over computer networks without user intervention.
        </p>

        <li class="modern-list">Trojan Horses:</li>
        <p class="text_content">
            Trojans appear to be legitimate software but contain malicious code that performs unauthorized 
            actions.
        </p>

        <li class="modern-list">Spyware:</li>
        <p class="text_content">
            Spyware secretly gathers user information and transmits it to third parties without consent.
        </p>

        <li class="modern-list">Adware:</li>
        <p class="text_content">
            Adware displays unwanted advertisements and collects user data for targeted marketing.
        </p>

        <li class="modern-list">Ransomware:</li>
        <p class="text_content">
            Ransomware encrypts user data and demands a ransom for decryption, posing a severe threat to 
            data privacy and integrity.
        </p>
    </ul>

    <!-- Protection Against Malware -->
    <h2 class="topics">Protection Against Malware</h2>
    <p class="text_content">
        To protect against computer viruses and malware, users and organizations should take several 
        preventive measures, including:
    </p>
    <ul class="text_content">
        <li class="modern-list">Using Antivirus Software:</li>
        <p class="text_content">
            Antivirus software scans for and removes known malware from the computer, 
            providing real-time protection against threats.
        </p>

        <li class="modern-list">Keeping Software Updated:</li>
        <p class="text_content">
            Regularly updating operating systems, applications, and browsers helps patch security 
            vulnerabilities and prevents malware exploits.
        </p>

        <li class="modern-list">Exercising Caution:</li>
        <p class="text_content">
            Avoid downloading files from unknown sources, clicking on suspicious links, or opening 
            unsolicited email attachments.
        </p>

        <li class="modern-list">Enabling Firewall Protection:</li>
        <p class="text_content">
            Firewalls block unauthorized network access, reducing the risk of malware infiltration.
        </p>

        <li class="modern-list">Backing Up Data:</li>
        <p class="text_content">
            Regular data backups ensure data recovery in case of ransomware attacks or 
            data loss due to malware infections.
        </p>
    </ul>

    <!-- Conclusion -->
    <h2 class="topics">Conclusion</h2>
    <p class="text_content">
        Computer viruses and malware pose significant threats to computer systems and user data. 
        Understanding their workings, types, and preventive measures is crucial to protect against 
        these malicious entities and ensure a safe and secure computing experience.
    </p>
    </div>


  <script>
        function openTab(evt, tabName) {
        var i, tabcontent, tablinks;
        tabcontent = document.getElementsByClassName("tabcontent");
        // Hide all tab content
        for (i = 0; i < tabcontent.length; i++) {
            tabcontent[i].style.display = "none";
        }
        tablinks = document.getElementsByClassName("tablinks");
        // Remove the 'active' class from all tab buttons
        for (i = 0; i < tablinks.length; i++) {
            tablinks[i].className = tablinks[i].className.replace(" active", "");
        }
        // Display the selected tab content and add the 'active' class to the button
        document.getElementById(tabName).style.display = "block";
        evt.currentTarget.className += " active";

        // Send the tab visit data to the same page using Fetch API
        fetch("computer_learning.php?tabName=" + tabName)
            .then(response => {
                if (!response.ok) {
                    throw new Error('Network response was not ok');
                }
                // Handle the response here if needed
            })
            .catch(error => {
                // Handle errors or other status codes here
            });
    }

    // Function to submit the form before the user leaves the page
    window.addEventListener("beforeunload", function () {
        // Create a new form element
        var form = document.createElement("form");
        form.setAttribute("method", "get");
        form.setAttribute("action", "computer_learning.php"); // Replace with your file name

        // Add the tabName input to the form
        var tabNameInput = document.createElement("input");
        tabNameInput.setAttribute("type", "hidden");
        tabNameInput.setAttribute("name", "tabName");
        tabNameInput.setAttribute("value", "tab_leave"); // A value to indicate that the user is leaving the tab
        form.appendChild(tabNameInput);

        // Append the form to the body and submit it
        document.body.appendChild(form);
        form.submit();
    });
    function logout() {
    // Send a request to the logout.php file using Fetch API
    fetch("../php/logout.php")
        .then(response => {
            if (!response.ok) {
                throw new Error('Network response was not ok');
            }
            // Handle the response here if needed
            // For example, you can redirect the user to the login page after successful logout
            window.location.href = "../html/login.html"; // Replace "login.php" with the page you want to redirect to
        })
        .catch(error => {
            // Handle errors or other status codes here
        });
}

  </script>
  

</body>
</html>
