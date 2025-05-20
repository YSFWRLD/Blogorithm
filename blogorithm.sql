-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 05, 2024 at 01:47 AM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `blogorithm`
--

-- --------------------------------------------------------

--
-- Table structure for table `posts`
--

CREATE TABLE `posts` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `category` varchar(100) DEFAULT NULL,
  `content` text NOT NULL,
  `image_url` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `author` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `posts`
--

INSERT INTO `posts` (`id`, `title`, `category`, `content`, `image_url`, `created_at`, `author`) VALUES
(14, 'Wearable Tech: Revolutionizing Health Monitoring', 'Technology', 'Wearable technology has become an essential part of modern life, offering a seamless way to monitor and improve health. Devices such as smartwatches, fitness bands, and even smart clothing are packed with sensors that track metrics like heart rate, steps, sleep quality, and blood oxygen levels.\r\n\r\nOne of the most exciting developments in wearables is their role in early detection of health issues. For example, wearable ECG monitors can alert users to irregular heart rhythms, potentially preventing life-threatening events. Similarly, devices equipped with SpO2 sensors are helping detect respiratory issues, including conditions like sleep apnea.\r\n\r\nThe future of wearables looks even brighter. Companies are developing non-invasive glucose monitors for diabetics, smart glasses that enhance vision and track eye health, and even implantable devices that provide continuous health updates. These innovations are not just for individuals but also for medical professionals, who can use wearable data for remote patient monitoring and personalized treatment plans. Despite their benefits, wearables also raise concerns about data privacy and accuracy. As technology advances, addressing these issues will be key to ensuring trust and widespread adoption.', 'images/health.png', '2024-12-05 00:23:45', 'maan'),
(15, 'Cybersecurity in the Age of AI', 'Technology', 'The integration of Artificial Intelligence (AI) into cybersecurity is transforming the way organizations protect their digital assets. AI-powered tools can detect and respond to threats in real time, analyzing massive datasets to identify suspicious patterns that might otherwise go unnoticed. This proactive approach is crucial in an era where cyberattacks are becoming increasingly sophisticated.\r\n\r\nHowever, the same AI advancements are also being exploited by cybercriminals. Hackers are using AI to create highly convincing phishing scams, develop malware that adapts to evade detection, and even orchestrate automated attacks on a massive scale. This arms race between attackers and defenders is pushing cybersecurity innovation to new heights.\r\n\r\nKey solutions include machine learning algorithms that can predict and neutralize threats, biometric security systems for enhanced authentication, and blockchain-based systems to secure sensitive data. Organizations must also prioritize cybersecurity education and foster a culture of vigilance among employees to mitigate risks.\r\n\r\nThe future of cybersecurity lies in striking a balance between AI\'s potential as a tool for defense and its misuse as a weapon. Collaboration between governments, tech companies, and researchers will be essential to staying ahead in this ever-evolving battle.', 'images/CyberAI.jpg', '2024-12-05 00:24:32', 'moe'),
(16, 'The Rise of Green Technology', 'Technology', 'As the world grapples with the challenges of climate change, green technology has emerged as a beacon of hope. This field encompasses innovations designed to reduce environmental impact while promoting sustainability. Solar panels, wind turbines, and electric vehicles are just the tip of the iceberg when it comes to green tech advancements.\r\n\r\nSolar energy, once expensive and inefficient, has become one of the most cost-effective renewable energy sources, with solar farms popping up worldwide. Wind energy is also growing rapidly, with offshore wind farms generating massive amounts of power without the carbon footprint of traditional energy sources.\r\n\r\nGreen technology is not limited to energy production. Carbon capture systems are being developed to extract CO2 from the atmosphere, while biodegradable materials are replacing plastics in packaging and manufacturing. Even in agriculture, smart irrigation systems powered by AI are helping conserve water while maximizing crop yields.\r\n\r\nDespite its promise, the green technology industry faces challenges, including high initial costs and resistance from traditional energy sectors. However, with growing investments and global policy support, green technology is poised to drive a more sustainable future for the planet.', 'images/therise.jpg', '2024-12-05 00:25:19', 'moh'),
(17, 'Quantum Computing: The Next Frontier', 'Technology', 'Quantum computing is no longer confined to science fiction—it\'s a rapidly developing field with the potential to revolutionize technology as we know it. Unlike classical computers, which use bits to process information as 0s or 1s, quantum computers use qubits that can exist in multiple states simultaneously, thanks to the principles of superposition and entanglement.\r\n\r\nThis computational power allows quantum computers to solve problems that are currently impossible for classical machines. For example, quantum algorithms can optimize complex logistical networks, accelerate drug discovery by simulating molecular interactions, and enhance cryptography by developing unbreakable encryption methods.\r\n\r\nDespite its promise, quantum computing is still in its infancy. Challenges such as qubit stability, error correction, and the high cost of development must be addressed. Leading tech companies like IBM, Google, and startups around the world are racing to make quantum computers practical for widespread use. If successful, this technology could unlock innovations across industries, reshaping the future of computing.', 'images/quantum.png', '2024-12-05 00:26:16', 'rwd'),
(18, 'Blockchain Beyond Cryptocurrency', 'Technology', 'When most people think of blockchain, cryptocurrencies like Bitcoin and Ethereum come to mind. However, blockchain\'s true potential lies in its ability to provide secure, transparent, and decentralized record-keeping across industries.\r\n\r\nIn supply chain management, blockchain is being used to track goods from production to delivery, ensuring transparency and reducing fraud. For instance, it allows companies to verify the authenticity of luxury goods or the ethical sourcing of raw materials. In healthcare, blockchain is revolutionizing the way medical records are stored and shared, ensuring data integrity and patient privacy.\r\n\r\nReal estate transactions, traditionally bogged down by paperwork and intermediaries, are also benefiting from blockchain technology. Smart contracts automate processes like property transfers, reducing costs and increasing efficiency.\r\n\r\nWhile the adoption of blockchain is growing, challenges such as scalability, energy consumption, and regulatory uncertainty remain. As solutions emerge, blockchain is set to redefine how we handle data and transactions across the globe.', 'images/block.jpg', '2024-12-05 00:27:10', 'yaz'),
(19, 'How 5G is Changing the Digital Landscape', 'Technology', 'The rollout of 5G technology is more than just an upgrade in internet speed—it\'s a revolutionary shift that is transforming connectivity as we know it. With speeds up to 100 times faster than 4G and significantly reduced latency, 5G enables near-instantaneous data transmission. This capability is driving advancements in smart cities, healthcare, gaming, and transportation.\r\n\r\nFor instance, in healthcare, 5G allows for real-time remote surgeries by enabling surgeons to control robotic tools with minimal delay. Similarly, autonomous vehicles depend on 5G for real-time data processing to ensure safety and efficiency. Gaming platforms are leveraging the technology to offer seamless cloud-based gaming experiences, eliminating the need for powerful local hardware.\r\n\r\nHowever, the global adoption of 5G is not without its challenges. Infrastructure costs are significant, and concerns over data security and potential health impacts are being debated. As countries continue to expand their 5G networks, the technology is poised to unlock unprecedented opportunities for innovation across all sectors.', 'images/5g.jpg', '2024-12-05 00:27:55', 'yaz'),
(20, 'Space Technology: The New Frontier of Innovation', 'Technology', 'Space technology is no longer just the domain of government agencies like NASA. Private companies such as SpaceX, Blue Origin, and Rocket Lab are redefining the industry, making space exploration more accessible and cost-effective. Innovations like reusable rockets, miniaturized satellites, and advanced propulsion systems are driving a new era of space exploration.\r\n\r\nOne of the most promising areas is satellite technology. Low Earth Orbit (LEO) satellites are enabling global internet coverage, connecting remote areas to the digital world. In addition, advancements in space telescopes and probes are helping scientists uncover the mysteries of the universe, from black holes to the search for extraterrestrial life.\r\n\r\nSpace technology also has terrestrial applications. For example, satellite data is critical for weather forecasting, disaster management, and environmental monitoring. As the commercialization of space continues, opportunities in space tourism, asteroid mining, and even lunar colonization are becoming viable.', 'images/The Future of AI.png', '2024-12-05 00:43:34', 'bsr');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` enum('admin','user') DEFAULT 'user',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `role`, `created_at`) VALUES
(1, 'ysf', '$2y$10$6wv9oRGKDV3IphumrfoVp.0MbbTI.t2hQh5dJoeijjcj3YAn0XxgK', 'admin', '2024-12-04 12:31:05'),
(10, 'moe', '$2y$10$S3xWhF3IubpOKACsIILrcOfieAf/UxHzFx0R1FqYu3P6sQer2.KhC', 'user', '2024-12-05 00:21:14'),
(11, 'rwd', '$2y$10$xVz0I2nAZv6RE9CcUYqF3u..Ou8Ox63m2.5ketLDeACYpVxSR3MD2', 'user', '2024-12-05 00:21:24'),
(12, 'yaz', '$2y$10$G.Z1OjJEKHhuIMl2EGFYlevGShAFAwXpr4nMLRR4c3w8GW.PQaVbS', 'user', '2024-12-05 00:21:47'),
(13, 'moh', '$2y$10$.CD6Ae567lSRhN808PeCOu1f3YPRnlIbaSQsYEMSur.mb6xQdBvT2', 'user', '2024-12-05 00:22:01'),
(14, 'maan', '$2y$10$qCCCDEYWBLP8.fczUmJwvO1Bo.mwZxkIT6jwmbOCcrans5QtHfei6', 'user', '2024-12-05 00:22:15'),
(15, 'bsr', '$2y$10$zSSpy7eDKTaCt29vG6ci/.aEsdVGWU5y9ftNlKsCpWKKDiHwYqSKK', 'user', '2024-12-05 00:22:23'),
(16, 'aron', '$2y$10$ygX7YB7oY9aIXcUlGMjNb.oJ0VmcPjQKYlTrA9WKdgFbhfPXwKPPK', 'admin', '2024-12-05 00:46:46');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `posts`
--
ALTER TABLE `posts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `posts`
--
ALTER TABLE `posts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
