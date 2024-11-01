<?php

namespace Uctoplus\UblWrapper\UBL\v21\MainDoc;

use Uctoplus\UblWrapper\UBL\Schema\MainDoc;
use Uctoplus\UblWrapper\UBL\v21\Common\AggregateComponents\AllowanceChargeType;
use Uctoplus\UblWrapper\UBL\v21\Common\AggregateComponents\BillingReferenceType;
use Uctoplus\UblWrapper\UBL\v21\Common\AggregateComponents\CustomerPartyType;
use Uctoplus\UblWrapper\UBL\v21\Common\AggregateComponents\DeliveryTermsType;
use Uctoplus\UblWrapper\UBL\v21\Common\AggregateComponents\DeliveryType;
use Uctoplus\UblWrapper\UBL\v21\Common\AggregateComponents\DocumentReferenceType;
use Uctoplus\UblWrapper\UBL\v21\Common\AggregateComponents\ExchangeRateType;
use Uctoplus\UblWrapper\UBL\v21\Common\AggregateComponents\InvoiceLineType;
use Uctoplus\UblWrapper\UBL\v21\Common\AggregateComponents\MonetaryTotalType;
use Uctoplus\UblWrapper\UBL\v21\Common\AggregateComponents\OrderReferenceType;
use Uctoplus\UblWrapper\UBL\v21\Common\AggregateComponents\PartyType;
use Uctoplus\UblWrapper\UBL\v21\Common\AggregateComponents\PaymentMeansType;
use Uctoplus\UblWrapper\UBL\v21\Common\AggregateComponents\PaymentTermsType;
use Uctoplus\UblWrapper\UBL\v21\Common\AggregateComponents\PaymentType;
use Uctoplus\UblWrapper\UBL\v21\Common\AggregateComponents\PeriodType;
use Uctoplus\UblWrapper\UBL\v21\Common\AggregateComponents\ProjectReferenceType;
use Uctoplus\UblWrapper\UBL\v21\Common\AggregateComponents\SignatureType;
use Uctoplus\UblWrapper\UBL\v21\Common\AggregateComponents\SupplierPartyType;
use Uctoplus\UblWrapper\UBL\v21\Common\AggregateComponents\TaxTotalType;
use Uctoplus\UblWrapper\UBL\v21\Common\BasicComponents\AccountingCostCodeType;
use Uctoplus\UblWrapper\UBL\v21\Common\BasicComponents\AccountingCostType;
use Uctoplus\UblWrapper\UBL\v21\Common\BasicComponents\BuyerReferenceType;
use Uctoplus\UblWrapper\UBL\v21\Common\BasicComponents\CopyIndicatorType;
use Uctoplus\UblWrapper\UBL\v21\Common\BasicComponents\CustomizationIDType;
use Uctoplus\UblWrapper\UBL\v21\Common\BasicComponents\DocumentCurrencyCodeType;
use Uctoplus\UblWrapper\UBL\v21\Common\BasicComponents\DueDateType;
use Uctoplus\UblWrapper\UBL\v21\Common\BasicComponents\IDType;
use Uctoplus\UblWrapper\UBL\v21\Common\BasicComponents\InvoiceTypeCodeType;
use Uctoplus\UblWrapper\UBL\v21\Common\BasicComponents\IssueDateType;
use Uctoplus\UblWrapper\UBL\v21\Common\BasicComponents\IssueTimeType;
use Uctoplus\UblWrapper\UBL\v21\Common\BasicComponents\LineCountNumericType;
use Uctoplus\UblWrapper\UBL\v21\Common\BasicComponents\NoteType;
use Uctoplus\UblWrapper\UBL\v21\Common\BasicComponents\PaymentAlternativeCurrencyCodeType;
use Uctoplus\UblWrapper\UBL\v21\Common\BasicComponents\PaymentCurrencyCodeType;
use Uctoplus\UblWrapper\UBL\v21\Common\BasicComponents\PricingCurrencyCodeType;
use Uctoplus\UblWrapper\UBL\v21\Common\BasicComponents\ProfileExecutionIDType;
use Uctoplus\UblWrapper\UBL\v21\Common\BasicComponents\ProfileIDType;
use Uctoplus\UblWrapper\UBL\v21\Common\BasicComponents\TaxCurrencyCodeType;
use Uctoplus\UblWrapper\UBL\v21\Common\BasicComponents\TaxPointDateType;
use Uctoplus\UblWrapper\UBL\v21\Common\BasicComponents\UUIDType;
use Uctoplus\UblWrapper\UBL\v21\Version;

/**
 * Class Invoice
 *
 * @copyright uctoplus.sk, a.s.
 * @package Uctoplus\UblWrapper\UBL\v21\MainDoc
 *
 * @method CustomizationIDType getCustomizationID()
 * @method self setCustomizationID(CustomizationIDType|string $value)
 * @method ProfileIDType getProfileID()
 * @method self setProfileID(ProfileIDType|string $value)
 * @method ProfileExecutionIDType getProfileExecutionID()
 * @method self setProfileExecutionID(ProfileExecutionIDType|string $value)
 * @method IDType getID()
 * @method self setID(IDType|string $value)
 * @method CopyIndicatorType getCopyIndicator()
 * @method self setCopyIndicator(CopyIndicatorType|string $value)
 * @method UUIDType getUUID()
 * @method self setUUID(UUIDType|string $value)
 * @method IssueDateType getIssueDate()
 * @method self setIssueDate(IssueDateType|string $value)
 * @method IssueTimeType getIssueTime()
 * @method self setIssueTime(IssueTimeType|string $value)
 * @method DueDateType getDueDate()
 * @method self setDueDate(DueDateType|string $value)
 * @method InvoiceTypeCodeType getInvoiceTypeCode()
 * @method self setInvoiceTypeCode(InvoiceTypeCodeType|string $value)
 * @method NoteType[] getNote()
 * @method self addNote(NoteType|string $value)
 * @method self setNote(NoteType ...$values)
 * @method TaxPointDateType getTaxPointDate()
 * @method self setTaxPointDate(TaxPointDateType|string $value)
 * @method DocumentCurrencyCodeType getDocumentCurrencyCode()
 * @method self setDocumentCurrencyCode(DocumentCurrencyCodeType|string $value)
 * @method TaxCurrencyCodeType getTaxCurrencyCode()
 * @method self setTaxCurrencyCode(TaxCurrencyCodeType|string $value)
 * @method PricingCurrencyCodeType getPricingCurrencyCode()
 * @method self setPricingCurrencyCode(PricingCurrencyCodeType|string $value)
 * @method PaymentCurrencyCodeType getPaymentCurrencyCode()
 * @method self setPaymentCurrencyCode(PaymentCurrencyCodeType|string $value)
 * @method PaymentAlternativeCurrencyCodeType getPaymentAlternativeCurrencyCode()
 * @method self setPaymentAlternativeCurrencyCode(PaymentAlternativeCurrencyCodeType|string $value)
 * @method AccountingCostCodeType getAccountingCostCode()
 * @method self setAccountingCostCode(AccountingCostCodeType|string $value)
 * @method AccountingCostType getAccountingCost()
 * @method self setAccountingCost(AccountingCostType|string $value)
 * @method LineCountNumericType getLineCountNumeric()
 * @method self setLineCountNumeric(LineCountNumericType|string $value)
 * @method BuyerReferenceType getBuyerReference()
 * @method self setBuyerReference(BuyerReferenceType|string $value)
 * @method PeriodType[] getInvoicePeriod()
 * @method self addInvoicePeriod(PeriodType $value)
 * @method self setInvoicePeriod(PeriodType ...$values)
 * @method OrderReferenceType getOrderReference()
 * @method self setOrderReference(OrderReferenceType $value)
 * @method BillingReferenceType[] getBillingReference()
 * @method self addBillingReference(BillingReferenceType $value)
 * @method self setBillingReference(BillingReferenceType ...$values)
 * @method DocumentReferenceType[] getDespatchDocumentReference()
 * @method self addDespatchDocumentReference(DocumentReferenceType $value)
 * @method self setDespatchDocumentReference(DocumentReferenceType ...$values)
 * @method DocumentReferenceType[] getReceiptDocumentReference()
 * @method self addReceiptDocumentReference(DocumentReferenceType $value)
 * @method self setReceiptDocumentReference(DocumentReferenceType ...$values)
 * @method DocumentReferenceType[] getStatementDocumentReference()
 * @method self addStatementDocumentReference(DocumentReferenceType $value)
 * @method self setStatementDocumentReference(DocumentReferenceType ...$values)
 * @method DocumentReferenceType[] getOriginatorDocumentReference()
 * @method self addOriginatorDocumentReference(DocumentReferenceType $value)
 * @method self setOriginatorDocumentReference(DocumentReferenceType ...$values)
 * @method DocumentReferenceType[] getContractDocumentReference()
 * @method self addContractDocumentReference(DocumentReferenceType $value)
 * @method self setContractDocumentReference(DocumentReferenceType ...$values)
 * @method DocumentReferenceType[] getAdditionalDocumentReference()
 * @method self addAdditionalDocumentReference(DocumentReferenceType $value)
 * @method self setAdditionalDocumentReference(DocumentReferenceType ...$values)
 * @method ProjectReferenceType[] getProjectReference()
 * @method self addProjectReference(ProjectReferenceType $value)
 * @method self setProjectReference(ProjectReferenceType ...$values)
 * @method SignatureType[] getSignature()
 * @method self addSignature(SignatureType $value)
 * @method self setSignature(SignatureType ...$values)
 * @method SupplierPartyType getAccountingSupplierParty()
 * @method self setAccountingSupplierParty(SupplierPartyType $value)
 * @method CustomerPartyType getAccountingCustomerParty()
 * @method self setAccountingCustomerParty(CustomerPartyType $value)
 * @method PartyType getPayeeParty()
 * @method self setPayeeParty(PartyType $value)
 * @method CustomerPartyType getBuyerCustomerParty()
 * @method self setBuyerCustomerParty(CustomerPartyType $value)
 * @method SupplierPartyType getSellerSupplierParty()
 * @method self setSellerSupplierParty(SupplierPartyType $value)
 * @method PartyType getTaxRepresentativeParty()
 * @method self setTaxRepresentativeParty(PartyType $value)
 * @method DeliveryType[] getDelivery()
 * @method self addDelivery(DeliveryType $value)
 * @method self setDelivery(DeliveryType ...$values)
 * @method DeliveryTermsType getDeliveryTerms()
 * @method self setDeliveryTerms(DeliveryTermsType $value)
 * @method PaymentMeansType[] getPaymentMeans()
 * @method self addPaymentMeans(PaymentMeansType $value)
 * @method self setPaymentMeans(PaymentMeansType ...$values)
 * @method PaymentTermsType[] getPaymentTerms()
 * @method self addPaymentTerms(PaymentTermsType $value)
 * @method self setPaymentTerms(PaymentTermsType ...$values)
 * @method PaymentType[] getPrepaidPayment()
 * @method self addPrepaidPayment(PaymentType $value)
 * @method self setPrepaidPayment(PaymentType ...$values)
 * @method AllowanceChargeType[] getAllowanceCharge()
 * @method self addAllowanceCharge(AllowanceChargeType $value)
 * @method self setAllowanceCharge(AllowanceChargeType ...$values)
 * @method ExchangeRateType getTaxExchangeRate()
 * @method self setTaxExchangeRate(ExchangeRateType $value)
 * @method ExchangeRateType getPricingExchangeRate()
 * @method self setPricingExchangeRate(ExchangeRateType $value)
 * @method ExchangeRateType getPaymentExchangeRate()
 * @method self setPaymentExchangeRate(ExchangeRateType $value)
 * @method ExchangeRateType getPaymentAlternativeExchangeRate()
 * @method self setPaymentAlternativeExchangeRate(ExchangeRateType $value)
 * @method TaxTotalType[] getTaxTotal()
 * @method self addTaxTotal(TaxTotalType $value)
 * @method self setTaxTotal(TaxTotalType ...$values)
 * @method TaxTotalType[] getWithholdingTaxTotal()
 * @method self addWithholdingTaxTotal(TaxTotalType $value)
 * @method self setWithholdingTaxTotal(TaxTotalType ...$values)
 * @method MonetaryTotalType getLegalMonetaryTotal()
 * @method self setLegalMonetaryTotal(MonetaryTotalType $value)
 * @method InvoiceLineType[] getInvoiceLine()
 * @method self addInvoiceLine(InvoiceLineType $value)
 * @method self setInvoiceLine(InvoiceLineType ...$values)
 */
class Invoice extends MainDoc
{
    protected $UBLVersionID = Version::VERSION_CODE;
    protected $xmlns = "urn:oasis:names:specification:ubl:schema:xsd:Invoice-2";

    protected $casts = [
        "cbc:CustomizationID" => CustomizationIDType::class,
        "cbc:ProfileID" => ProfileIDType::class,
        "cbc:ProfileExecutionID" => ProfileExecutionIDType::class,
        "cbc:ID" => IDType::class,
        "cbc:CopyIndicator" => CopyIndicatorType::class,
        "cbc:UUID" => UUIDType::class,
        "cbc:IssueDate" => IssueDateType::class,
        "cbc:IssueTime" => IssueTimeType::class,
        "cbc:DueDate" => DueDateType::class,
        "cbc:InvoiceTypeCode" => InvoiceTypeCodeType::class,
        "cbc:Note" => NoteType::class . "[]",
        "cbc:TaxPointDate" => TaxPointDateType::class,
        "cbc:DocumentCurrencyCode" => DocumentCurrencyCodeType::class,
        "cbc:TaxCurrencyCode" => TaxCurrencyCodeType::class,
        "cbc:PricingCurrencyCode" => PricingCurrencyCodeType::class,
        "cbc:PaymentCurrencyCode" => PaymentCurrencyCodeType::class,
        "cbc:PaymentAlternativeCurrencyCode" => PaymentAlternativeCurrencyCodeType::class,
        "cbc:AccountingCostCode" => AccountingCostCodeType::class,
        "cbc:AccountingCost" => AccountingCostType::class,
        "cbc:LineCountNumeric" => LineCountNumericType::class,
        "cbc:BuyerReference" => BuyerReferenceType::class,
        "cac:InvoicePeriod" => PeriodType::class . "[]",
        "cac:OrderReference" => OrderReferenceType::class,
        "cac:BillingReference" => BillingReferenceType::class . "[]",
        "cac:DespatchDocumentReference" => DocumentReferenceType::class . "[]",
        "cac:ReceiptDocumentReference" => DocumentReferenceType::class . "[]",
        "cac:StatementDocumentReference" => DocumentReferenceType::class . "[]",
        "cac:OriginatorDocumentReference" => DocumentReferenceType::class . "[]",
        "cac:ContractDocumentReference" => DocumentReferenceType::class . "[]",
        "cac:AdditionalDocumentReference" => DocumentReferenceType::class . "[]",
        "cac:ProjectReference" => ProjectReferenceType::class . "[]",
        "cac:Signature" => SignatureType::class . "[]",
        "cac:AccountingSupplierParty" => SupplierPartyType::class,
        "cac:AccountingCustomerParty" => CustomerPartyType::class,
        "cac:PayeeParty" => PartyType::class,
        "cac:BuyerCustomerParty" => CustomerPartyType::class,
        "cac:SellerSupplierParty" => SupplierPartyType::class,
        "cac:TaxRepresentativeParty" => PartyType::class,
        "cac:Delivery" => DeliveryType::class . "[]",
        "cac:DeliveryTerms" => DeliveryTermsType::class,
        "cac:PaymentMeans" => PaymentMeansType::class . "[]",
        "cac:PaymentTerms" => PaymentTermsType::class . "[]",
        "cac:PrepaidPayment" => PaymentType::class . "[]",
        "cac:AllowanceCharge" => AllowanceChargeType::class . "[]",
        "cac:TaxExchangeRate" => ExchangeRateType::class,
        "cac:PricingExchangeRate" => ExchangeRateType::class,
        "cac:PaymentExchangeRate" => ExchangeRateType::class,
        "cac:PaymentAlternativeExchangeRate" => ExchangeRateType::class,
        "cac:TaxTotal" => TaxTotalType::class . "[]",
        "cac:WithholdingTaxTotal" => TaxTotalType::class . "[]",
        "cac:LegalMonetaryTotal" => MonetaryTotalType::class,
        "cac:InvoiceLine" => InvoiceLineType::class . "[]",
    ];

    protected $minOccurs = [
        "cbc:ID" => 1,
        "cbc:IssueDate" => 1,
        "cac:AccountingSupplierParty" => 1,
        "cac:AccountingCustomerParty" => 1,
        "cac:LegalMonetaryTotal" => 1,
        "cac:InvoiceLine" => 1,
    ];
}