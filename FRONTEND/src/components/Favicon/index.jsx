import { useEffect } from "react";
import Path from "~/helpers/Path";

const Favicon = () => {
  useEffect(() => {
    const link = document.createElement("link");
    link.rel = "icon";
    link.type = "image/svg+xml";
    link.href = Path.publicLogo4();
    document.head.appendChild(link);

    return () => {
      document.head.removeChild(link); // Cleanup nếu cần
    };
  }, []);

  return null; // Component không render gì
};

export default Favicon;
