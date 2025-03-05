import { useState } from "react";
import {
    Box,
    Typography,
    Button,
    Rating,
    Select,
    MenuItem,
    FormControl,
    InputLabel,
    TableContainer,
    Table,
    TableBody,
    TableRow,
    TableCell,
} from "@mui/material";
import PaperCustom from "~/components/PaperCustom";
import { FavoriteBorder } from "@mui/icons-material";
import Path from "~/helpers/Path";
import ButtonLoading from "~/components/ButtonLoading";

const ImageProduct = ({ images }) => {
    const defaultImage = images && images.find((image) => image.default === 1);

    return (
        <>
            {images && (
                <Box
                    sx={{
                        width: "40%",
                        display: "flex",
                        flexDirection: "column",
                        justifyContent: "start",
                        alignItems: "center",
                    }}
                >
                    <Box sx={{ padding: 2 }}>
                        <img
                            src={Path.publicProduct(defaultImage?.image_path)}
                            alt="Product Image"
                            style={{
                                width: "100%",
                                maxWidth: "400px",
                                objectFit: "contain",
                                margin: "auto",
                            }}
                        />
                    </Box>
                    <Box sx={{ padding: 2, display: "flex", gap: 2 }}>
                        {images &&
                            images.map((image, key) => (
                                <img
                                    key={key}
                                    src={Path.publicProduct(image.image_path)}
                                    alt="Product Image"
                                    style={{
                                        width: "100px",
                                        maxWidth: "400px",
                                        objectFit: "contain",
                                        margin: "auto",
                                    }}
                                />
                            ))}
                    </Box>
                </Box>
            )}
        </>
    );
};

const InfoProduct = ({ product }) => {
    const [selectedValues, setSelectedValues] = useState({});

    const handleShowPrice = (key, value) => {
        if (selectedValues[key] === value) {
            setSelectedValues((prev) => ({
                ...prev,
                [key]: null,
            }));
        } else {
            setSelectedValues((prev) => ({
                ...prev,
                [key]: value,
            }));
        }

        console.log(selectedValues);
    };
    return (
        <>
            {product && (
                <Box sx={{ width: "60%", padding: 2 }}>
                    <Typography className="line-clamp-3" variant="h5">
                        {product.name}
                    </Typography>
                    <Box sx={{ display: "flex", alignItems: "center" }}>
                        <Typography variant="body2" color="textSecondary">
                            {product.average_rating}
                        </Typography>

                        <Rating
                            size="small"
                            name="read-only"
                            readOnly
                            value={
                                product.average_rating
                                    ? parseFloat(product.average_rating)
                                    : 0
                            }
                            precision={0.1}
                        />
                        <Typography
                            variant="body2"
                            color="textSecondary"
                            sx={{ marginLeft: 1 }}
                        >
                            ({product.count_reviews} đánh giá)
                        </Typography>
                    </Box>
                    <Typography
                        variant="h5"
                        fontWeight={"bold"}
                        color="#fff"
                        sx={{ padding: 2, bgcolor: "primary.light" }}
                    >
                        {/* Nơi hiển thị gi */}
                    </Typography>
                    <TableContainer>
                        <Table
                            sx={{ borderCollapse: "collapse", border: "none" }}
                        >
                            <TableBody>
                                {product.attributes &&
                                    Object.keys(product.attributes).map(
                                        (key, index) => (
                                            <TableRow key={index}>
                                                <TableCell
                                                    sx={{
                                                        width: "20%",
                                                        px: 0,
                                                        py: 1,
                                                        border: "none",
                                                    }}
                                                >
                                                    {key}
                                                </TableCell>
                                                <TableCell
                                                    sx={{
                                                        px: 0,
                                                        py: 1,
                                                        border: "none",
                                                    }}
                                                >
                                                    <Box
                                                        sx={{
                                                            display: "flex",
                                                            gap: 1,
                                                            flexWrap: "wrap",
                                                        }}
                                                    >
                                                        {" "}
                                                        {product.attributes[
                                                            key
                                                        ].map(
                                                            (
                                                                value,
                                                                subIndex
                                                            ) => (
                                                                <Button
                                                                    variant="outlined"
                                                                    key={
                                                                        subIndex
                                                                    }
                                                                    onClick={() =>
                                                                        handleShowPrice(
                                                                            key,
                                                                            value
                                                                        )
                                                                    }
                                                                    sx={{
                                                                        backgroundColor:
                                                                            selectedValues[
                                                                                key
                                                                            ] ===
                                                                            value
                                                                                ? "primary.light"
                                                                                : "#fff",
                                                                        color:
                                                                            selectedValues[
                                                                                key
                                                                            ] ===
                                                                            value
                                                                                ? "#fff"
                                                                                : "primary.light",
                                                                    }}
                                                                >
                                                                    {value}
                                                                </Button>
                                                            )
                                                        )}
                                                    </Box>
                                                </TableCell>
                                            </TableRow>
                                        )
                                    )}
                            </TableBody>
                        </Table>
                    </TableContainer>
                    <Box sx={{ display: "flex", gap: 2 }}>
                        <ButtonLoading
                            sx={{ width: "50%" }}
                            variant="contained"
                        >
                            Mua ngay
                        </ButtonLoading>
                        <ButtonLoading
                            sx={{ width: "50%" }}
                            variant="contained"
                        >
                            Mua ngay
                        </ButtonLoading>
                    </Box>
                </Box>
            )}
        </>
    );
};

const ProductInfo = ({ product }) => {
    return (
        <PaperCustom sx={{ display: "flex" }}>
            <ImageProduct images={product?.images} />
            <InfoProduct product={product} />
        </PaperCustom>
    );
};

export default ProductInfo;
