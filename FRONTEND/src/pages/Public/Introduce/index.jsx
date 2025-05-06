import { useEffect } from "react";
import { useNavigate, useParams } from "react-router-dom";
import PaperCustom from "~/components/PaperCustom";
import Path from "~/helpers/Path";
import About from "./About";

const RenderPage = ({ page }) => {
  switch (page) {
    case "about":
      return <About />;
    case "buying-guide":
      return <div>buying-guide</div>;
    case "payment-nstructions":
      return <div>payment-nstructions</div>;
    case "sales-registration-guide":
      return <div>sales-registration-guide</div>;
    case "shipping-policy":
      return <div>shipping-policy</div>;
    case "privacy-policy":
      return <div>privacy-policy</div>;
    case "terms-of-use":
      return <div>terms-of-use</div>;
    default:
      return null;
  }
};

const Introduce = () => {
  const params = useParams();
  const navigate = useNavigate();

  const page = params.page;

  useEffect(() => {
    const validStatuses = [
      "about",
      "buying-guide",
      "payment-nstructions",
      "sales-registration-guide",
      "shipping-policy",
      "privacy-policy",
      "terms-of-use",
    ];

    if (page && !validStatuses.includes(page)) {
      navigate(Path.introduce("about"));
    }
  }, [page, navigate]);

  return (
    <>
      <PaperCustom>
        <RenderPage page={page} />
      </PaperCustom>
    </>
  );
};

export default Introduce;
