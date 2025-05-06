import { useEffect } from "react";
import { useNavigate, useParams } from "react-router-dom";
import PaperCustom from "~/components/PaperCustom";
import Path from "~/helpers/Path";

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
      <PaperCustom>{page}</PaperCustom>
    </>
  );
};

export default Introduce;
